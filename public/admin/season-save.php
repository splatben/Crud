<?php


use Exception\ParameterException;
use Html\Form\SeasonForm;

try {
    $SeasonForm = new SeasonForm();
    $SeasonForm->setEntityFromQueryString();
    $SeasonForm->getSeason()->save();
    header('location: /');
    exit;

} catch (ParameterException) {
    http_response_code(400);
} catch (Exception) {
    http_response_code(500);
}
