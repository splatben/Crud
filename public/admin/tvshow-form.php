<?php

declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Entity\Tvshow;
use Exception\ParameterException;
use Html\AppWebPage;
use Html\Form\TvshowForm;

try {
    $webPage = new appWebPage();
    $show = null;
    $title = "Ajouter une série";
    if (!empty($_GET['tvshowId']) && ctype_digit($_GET['tvshowId'])) {
        $show = Tvshow::findById((int) $_GET['tvshowId']);
        $title = "Modifier la série {$webPage->escapeString($show->getName())}";
    }
    $webPage->setTitle($title);
    $tvshowForm = new TvshowForm($show);
    $webPage->appendContent($tvshowForm->getHtmlForm("tvshow-save.php"));
    echo $webPage->toHtml();

} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}
