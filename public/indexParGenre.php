<?php

declare(strict_types=1);


use Entity\Collection\TvshowCollection;
use Entity\Genre;
use Html\AppWebPage;
use Entity\Tvshow;

$genreId = 1;
if (!empty($_GET['genreId']) && ctype_digit($_GET['genreId'])) {
    $genreId = (int)$_GET['genreId'];
} else {
    header('location: /');
    exit;
}
$genre = Genre::findById($genreId);
$webPage = new AppWebPage("Séries TV du genre {$genre->getName()}");
$webPage->appendCssUrl("style/index.css");
foreach ($genre->getTvShows() as $show) {
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
