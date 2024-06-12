<?php

declare(strict_types=1);


use Entity\Exception\EntityNotFoundException;
use Entity\Poster;
use Exception\ParameterException;

try {
    $posterId = null;
    if (!empty($_GET['posterId']) && ctype_digit($_GET['posterId'])) {
        $posterId = (int) $_GET['posterId'];
    } else {
        header('content-Type: image/jpeg');
        echo readfile('img/default.png');
        exit;
    }

    $poster = Poster::findById($posterId);
    header('content-Type: image/jpeg');
    echo $poster->getJpeg();
} catch (ParameterException $e) {
    http_response_code(400);
} catch (EntityNotFoundException $e) {
    http_response_code(404);
} catch (Exception $e) {
    http_response_code(500);
}
