<?php

declare(strict_types=1);


use Entity\Collection\TvshowCollection;
use Html\AppWebPage;
use Entity\Tvshow;

$webPage = new AppWebPage();
$webPage->setTitle("Séries TV");
$webPage->appendCssUrl("style/index.css");
$webPage->appendButtonToMenu("indexByGenre.php?genreId=1", "Index Par genre");
$webPage->appendButtonToMenu("admin/tvshow-form.php", "Ajouter");
$webPage->appendContent(<<<HTML
<div class="list__show">

HTML);

$tvShows = TvshowCollection::findAll();
foreach ($tvShows as $show) {
    $webPage->appendContent(<<<HTML
    <div class="show">
        <img src="{$show->getPoster()}" alt="poster">
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
