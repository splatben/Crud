<?php

declare(strict_types=1);


use Entity\Collection\TvshowCollection;
use Html\AppWebPage;
use Entity\Tvshow;

$webPage = new AppWebPage();
$webPage->setTitle("Séries TV");
$webPage->appendCssUrl("style/index.css");
$webPage->appendButtonToMenu("indexParGenre.php?genreId=1", "Index Par genre");
$webPage->appendContent(<<<HTML
<div class="list__show">

HTML);

$tvShows = TvshowCollection::findAll();
foreach ($tvShows as $show) {
    $source = "poster.php?posterId={$show->getPosterId()}";
    $webPage->appendContent(<<<HTML
    <div class="show">
        <img src="$source" alt="poster">
        <div class="show__info">
            <a class = "link" href="tvshow.php?tvshowId={$show->getId()}">
            <article class="show__name">{$webPage->escapeString($show->getName())}</article>
            <article class="show__desc">{$webPage->escapeString($show->getOverview())}</article>
            </a>
        </div>
    </div>
HTML);

}

$webPage->appendContent('</div>');
echo $webPage->toHtml();
