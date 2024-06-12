<?php

use Entity\Exception\EntityNotFoundException;
use Entity\Season;
use Entity\Tvshow;
use Exception\ParameterException;
use Html\AppWebPage;
use Html\Form\SeasonForm;

try {
    $title = "";
    $show = null;
    $webPage = new appWebPage();
    if (!empty($_GET['tvShowId']) && ctype_digit($_GET['tvShowId'])) {
        $show = Tvshow::findById((int) $_GET['tvShowId']);
        $title = "Ajout d'une saison à {$webPage->escapeString($show->getName())}";
    } else {
        throw new ParameterException();
    }

    $seas = null;
    if (!empty($_GET['seasonId']) && ctype_digit($_GET['seasonId'])) {
        $seas = Season::findById((int) $_GET['seasonId']);
        $title = "Modifier la saison {$webPage->escapeString($seas->getName())} de la série {$webPage->escapeString($show->getName())}";
    }
    $webPage->setTitle($title);
    $seasonForm = new SeasonForm($show, $seas);
    $webPage->appendContent($seasonForm->getHtmlForm("season-save.php"));
    echo $webPage->toHtml();

} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}
