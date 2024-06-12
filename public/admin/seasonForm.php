<?php

use Entity\Exception\EntityNotFoundException;
use Entity\Season;
use Exception\ParameterException;
use Html\AppWebPage;
use Html\Form\SeasonForm;

try {
    $webPage = new appWebPage();
    $seas = null;
    $title = "Ajouter une saison a la série de votre choix";
    if (!empty($_GET['seasonId']) && ctype_digit($_GET['seasonId'])) {
        $seas = Season::findById((int) $_GET['seasonId']);
        $title = "Modifier la saison {$webPage->escapeString($seas->getName())}";
    }
    $webPage->setTitle($title);
    $seasonForm = new SeasonForm($seas);
    $webPage->appendContent($seasonForm->getHtmlForm("tvshow-save.php"));
    echo $webPage->toHtml();

} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}
