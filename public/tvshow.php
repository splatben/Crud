<?php

declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Entity\Tvshow;
use Entity\Season;
use Exception\ParameterException;
use Html\AppWebPage;

try {
    $tvshowId = null;
    if (isset($_GET['tvshowId']) && !empty($_GET['tvshowId']) && ctype_digit($_GET['tvshowId'])) {
        $tvshowId = (int)$_GET['tvshowId'];
    } else {
        header('location: /');
        exit;
    }


    $show = Tvshow::findById($tvshowId);
    $webPage = new AppWebPage();

    $title = "Séries TV : {$webPage->escapeString($show->getName())}";
    $webPage->setTitle($title);
    $webPage = new AppWebPage($title);
    $webPage->appendCssUrl("style/tvshow.css");


    $sourcePosterShow = "img/default.png";
    if ($show->getPosterId() !== null) {
        $sourcePosterShow = "poster.php?posterId={$show->getPosterId()}";
    }

    $webPage->appendContent(
        <<<HTML
    <div class="show">
        <img src="$sourcePosterShow" alt="Poster show">
        <div class="show__info">
            <article class="show__title">{$webPage->escapeString($show->getName())}</article>
            <article class="show__title">{$webPage->escapeString($show->getOriginalName())}</article>
            <article class="show__desc">{$webPage->escapeString($show->getOverview())}</article>
        </div>
    </div>
    <div class="list__season">

HTML
    );

    $seasons = $show->getSeasons();

    foreach ($seasons as $season) {
        $sourcePosterSeason = "poster.php?posterId={$season->getPosterId()}";
        $webPage->appendContent(
            <<<HTML
        <div class="season">
            <a class = "link" href="episode.php?seasonId={$season->getid()}">
            <img src="$sourcePosterSeason" alt="Poster season">
            <article class="season__title">{$webPage->escapeString($season->getName())}</article>
            </a>
        </div>

HTML
        );
    }
    $webPage->appendContent("</div>");

    echo $webPage->toHtml();

} catch (ParameterException $e) {
    http_response_code(400);
} catch (EntityNotFoundException $e) {
    http_response_code(404);
} catch (Exception $e) {
    http_response_code(500);
}
