<?php

declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Entity\Tvshow;
use Html\AppWebPage;

$tvshowId = null;
if (isset($_GET['tvshowId']) && !empty($_GET['tvshowId']) && ctype_digit($_GET['tvshowId'])) {
    $tvshowId = (int) $_GET['tvshowId'];
} else {
    header('location: /');
    exit;
}

try {
    $show = Tvshow::findById($tvshowId);
} catch (EntityNotFoundException) {
    http_response_code(404);
    exit;
}

$title = "Séries TV : {$show->getName()}";

$webPage = new AppWebPage($title);
$sourcePosterShow = "img/default.png";
if ($show->getPosterId() !== null) {
    $sourcePosterShow = "poster.php?posterId={$show->getPosterId()}";
}

$webPage->appendContent(<<<HTML
    <div class="show">
        <img src="$sourcePosterShow">
        <div class="show__info">
            <a class="show_titre">{$show->getName()}</a>
            <a class="show_titre">{$show->getName()}</a>

        </div>
    </div>

HTML);
