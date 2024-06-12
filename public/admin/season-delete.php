<?php

declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Entity\Season;
use Exception\ParameterException;

try {
    $seas = null;
    if (!empty($_GET['seasonId']) && ctype_digit($_GET['seasonId'])) {
        $seas = Season::findById((int) $_GET['seasonId']);
    } else {
        throw new ParameterException();
    }
    $seas->delete();
    header('location: /index.php');
    exit;
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}
