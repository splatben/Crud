<?php

declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Entity\Tvshow;
use Exception\ParameterException;
use Html\Form\TvshowForm;

try {
    $show = null;
    if (!empty($_GET['tvshowId']) && ctype_digit($_GET['tvshowId'])) {
        $show = Tvshow::findById((int) $_GET['tvshowId']);
    }

    $tvshowForm = new TvshowForm($show);
    echo $tvshowForm->getHtmlForm("artist-save.php");

} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}
