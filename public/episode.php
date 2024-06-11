<?php

use Entity\Exception\EntityNotFoundException;
use Entity\Season;
use Entity\Tvshow;
use Exception\ParameterException;
use Html\AppWebPage;

try {
    if (isset($_GET['seasonId']) && !empty($_GET['seasonId']) && ctype_digit($_GET['seasonId'])) {
        $seasonId = $_GET['seasonId'];
    } else {
        throw new ParameterException();
    }
    $html = new AppWebPage();
    $season = Season::findById($seasonId);
    $nomSerie = $html->escapeString(Tvshow::findById($season->getTvShowId())->getName());
    $html = new AppWebPage("Série Tv : {($nomSerie} \n {$html->escapeString($season->getName())}");
    $html->appendCss(
        <<<CSS
    .Saison,.Episode{
    display: flex;
    flex-flow: row nowrap;
    border : 2px solid #5e9393;
    }
    .Titre{
    display:flex;
    justify-content: flex-end;
    }
    .Episode{
    flex-grow: 1;
    }
    .Saison{
    flex-grow: 2;
    }
CSS
    );
    $html->appendContent(
        <<<HTML
<div class = "Saison">
   <img src = "poster.php?posterId = {$html->escapeString($season->getPosterId())}">
   <p class = "Titre">{$html->escapeString($season->getName())}</p>
   <p class = "Titre">$nomSerie</p>
</div>
HTML
    );
    foreach($season->getEpisodes() as $episode) {
        $html->appendContent(
            <<<HTML
<div class="Episode">
    <p> {$html->escapeString($episode->getEpisodeNumber())} - {$html->escapeString($episode->getEpisodeName())}</p>
    <br>
    <p> {$html->escapeString($episode->getOverview())}</p>
</div>
HTML
        );
    }
    echo $html->toHtml();
} catch(EntityNotFoundException $e) {
    http_response_code(404);
} catch(ParameterException $e) {
    http_response_code(400);
} catch(Exception $e) {
    http_response_code(500);
}
