<?php

declare(strict_types=1);


use Entity\Collection\TvshowCollection;
use Html\AppWebPage;
use Entity\Tvshow;

$webPage = new AppWebPage();
$webPage->setTitle("Séries TV");
$webPage->appendCssUrl("style/index.css");


$webPage->appendContent(<<<HTML
<div class="list__show">

HTML);

$tvShows = TvshowCollection::findAll();
foreach ($tvShows as $show) {
    $source = "img/default.png";
    if ($show->getPosterId() !== null) {
        $source = "poster.php?posterId={$show->getPosterId()}";
    }

    $webPage->appendContent(<<<HTML
    <div class="show">
        <a class="link" href="tvshow.php?tvshowId={$show->getId()}">
        <img src="$source" alt="poster">
        <div class="show__info">
            <a href="tvshow.php?tvshowId={$show->getId()}" class="show__name">{$webPage->escapeString($show->getName())}</a>
            <a class="show__desc">{$webPage->escapeString($show->getOverview())}</a>
        </div>

    </div>


HTML);

}

$webPage->appendContent('</div>');
echo $webPage->toHtml();
