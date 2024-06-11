<?php

declare(strict_types=1);


use Database\MyPdo;
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
if($genreId > 1) {
    $genreBefore = $genreId - 1;
    $webPage->appendButtonToMenu("indexParGenre.php?genreId=$genreBefore", "Genre précédent");
}
$idMax = MyPdo::getInstance()->prepare("Select Max(id) from genre;");
$idMax->execute();
$idMax = $idMax->fetch(PDO::FETCH_NUM)[0];
if ($genreId < $idMax) {
    $genreAfter = $genreId + 1;
    $webPage->appendButtonToMenu("indexParGenre.php?genreId=$genreAfter", "Genre Suivant");
}
$webPage->appendContent(<<<HTML
<div class="list__show">

HTML);
foreach ($genre->getTvShows() as $show) {
    $webPage->appendContent(<<<HTML
    <div class="show">
        <img src=""{$show->getPoster()}" alt="poster">
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
