<?php

declare(strict_types=1);

use Exception\ParameterException;
use Html\Form\TvshowForm;

try {
    $tvshowForm = new TvshowForm();
    $tvshowForm->setEntityFromQueryString();
    $tvshowForm->getShow()->save();
    header('location: /');
    exit;

} catch (ParameterException) {
    http_response_code(400);
} catch (Exception) {
    http_response_code(500);
}