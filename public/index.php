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

$tvshows = TvshowCollection::findAll();
foreach ($tvshows as $show) {
    $source = "img/default.png";

    $webPage->appendContent(<<<HTML
    <div class="show">
        <img src="$source" alt="poster">
        <div class="show__info">
            <a class="show__name">{$show->getName()}</a>
            <a class="show__desc">{$show->getOverview()}</a>
        </div>
    </div>


HTML);
}

$webPage->appendContent('</div>');
echo $webPage->toHtml();
