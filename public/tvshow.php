<?php

declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Entity\Tvshow;
use Entity\Season;
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
        <img src="$sourcePosterShow" alt="Poster show">
        <div class="show__info">
            <a class="show__title">{$show->getName()}</a>
            <a class="show__title">{$show->getOriginalName()}</a>
            <a class="show__desc">{$show->getOverview()}</a>
        </div>
    </div>
    <div class="list__season">

HTML);

$seasons = $show->getSeasons();

foreach ($seasons as $season) {
    $sourcePosterSeason = "img/default.png";
    $webPage->appendContent(<<<HTML
        <div class="season">
            <img src="$sourcePosterSeason" alt="Poster season">
            <a class="season__title">{$season->getName()}</a>
        </div>

HTML);
}
$webPage->appendContent("</div>");


echo $webPage->toHtml();
