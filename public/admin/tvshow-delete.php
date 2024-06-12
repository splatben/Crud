<?php

declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Entity\Tvshow;
use Exception\ParameterException;

try {
    $show = null;
    if (!empty($_GET['tvshowId']) && ctype_digit($_GET['tvshowId'])) {
        $show = Tvshow::findById((int) $_GET['tvshowId']);
    } else {
        throw new ParameterException();
    }
    $show->delete();
    header('location: /index.php');
    exit;
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}
