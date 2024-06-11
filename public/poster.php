<?php

declare(strict_types=1);


use Entity\Exception\EntityNotFoundException;
use Entity\Poster;
use Exception\ParameterException;

try {
    if (!empty($_GET['posterId']) && ctype_digit($_GET['posterId'])) {
        $posterId = (int) $_GET['posterId'];
    } else {
        header('content-Type: image/jpeg');
        echo file_get_contents(codecept_data_dir().'/img/default.png');
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
