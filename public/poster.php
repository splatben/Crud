<?php

declare(strict_types=1);


use Entity\Exception\EntityNotFoundException;
use Entity\Poster;
use Exception\ParameterException;

try {
    if (isset($_GET['posterId']) && !empty($_GET['posterId']) && ctype_digit($_GET['posterId'])) {
        $posterId = (int) $_GET['posterId'];
    } else {
        throw new ParameterException();
    }

    $poster = Poster::findById($posterId);
    header('content-Type: image/jpeg');
    echo $poster->getJpeg();

} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}
