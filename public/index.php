<?php

declare(strict_types=1);


use Database\MyPdo;
use Entity\Collection\TvshowCollection;
use Entity\Exception\EntityNotFoundException;
use Entity\Genre;
use Exception\ParameterException;
use Html\AppWebPage;
use Entity\Tvshow;

try {
    $SortByGenre = true;
    $genreId = 1;
    if (!empty($_GET['genreId']) && ctype_digit($_GET['genreId'])) {
        $genreId = (int)$_GET['genreId'];
    } else {
        $SortByGenre = false;
    }
    $webPage = new AppWebPage();
    $webPage->appendButtonToMenu("admin/tvshow-form.php", "Ajouter");
    if ($SortByGenre) {
        $genre = Genre::findById($genreId);
        $webPage->setTitle("Séries TV du genre {$genre->getName()}");
        if ($genreId > 1) {
            $genreBefore = $genreId - 1;
            $webPage->appendButtonToMenu("index.php?genreId=$genreBefore", "Genre précédent");
        }
        $idMax = MyPdo::getInstance()->prepare("Select Max(id) from genre;");
        $idMax->execute();
        $idMax = $idMax->fetch(PDO::FETCH_NUM)[0];
        if ($genreId < $idMax) {
            $genreAfter = $genreId + 1;
            $webPage->appendButtonToMenu("index.php?genreId=$genreAfter", "Genre Suivant");
        }
    } else {
        $webPage->setTitle("Série Tv");
        $webPage->appendButtonToMenu("index.php?genreId=1", "Index Par genre");
    }
    $webPage->appendCssUrl("style/index.css");
    $webPage->appendContent(
        <<<HTML
    <div class="list__show">
    
    HTML
    );
    $tvShows = null;
    if ($SortByGenre) {
        $tvShows = $genre->getTvShows();
    } else {
        $tvShows = TvshowCollection::findAll();
    }
    foreach ($tvShows as $show) {
        $webPage->appendContent(
            <<<HTML
        <div class="show">
            <img src="{$show->getPoster()}" alt="poster">
            <div class="show__info">
                <a class = "link" href="tvshow.php?tvshowId={$show->getId()}">
                <article class="show__name">{$webPage->escapeString($show->getName())}</article>
                <article class="show__desc">{$webPage->escapeString($show->getOverview())}</article>
                </a>
            </div>
        </div>
    HTML
        );

    }

    $webPage->appendContent('</div>');
    echo $webPage->toHtml();
} catch (ParameterException $e) {
    http_response_code(400);
} catch (EntityNotFoundException $e) {
    http_response_code(404);
} catch (Exception $e) {
    http_response_code(500);
}
