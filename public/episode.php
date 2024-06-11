<?php

use Entity\Exception\EntityNotFoundException;
use Entity\Season;
use Entity\Tvshow;
use Exception\ParameterException;
use Html\AppWebPage;

try {
    if (!empty($_GET['seasonId']) && ctype_digit($_GET['seasonId'])) {
        $seasonId = $_GET['seasonId'];
    } else {
        throw new ParameterException();
    }
    $html = new AppWebPage();
    $season = Season::findById($seasonId);
    $seriesName = $html->escapeString(Tvshow::findById($season->getTvShowId())->getName());
    $html = new AppWebPage("Série Tv : $seriesName \n {$html->escapeString($season->getName())}");
    $html->appendCss(
        <<<CSS
    .Season,.Episode{
    display: flex;
    flex-flow: row wrap;
    border : 2px solid #456969;
    margin: 4px;
    background-color: #5e9393;  
    }
    .Episode{
    flex-grow: 1;
    border-radius : 20px;
    }
    .Saison{
    font-size: 30px;
    padding : 10px;
    flex-grow: 2; 
    justify-content: space-between;   
    }
    .Info{
    display: flex;
    flex-direction: column;
    justify-items: start;
    font-size: 20px;
    }
    CSS
    );
    $html->appendContent(
        <<<HTML
    <div class = "Season">
       <img src = "poster.php?posterId={$season->getPosterId()}" alt="Poster de la saison {$season->getName()}du show Télévisée de $seriesName">
       <div class = "Info">
       <article>{$html->escapeString($season->getName())} </article>
       <article>$seriesName</article>
       </div>
    </div>
    HTML
    );
    foreach($season->getEpisodes() as $episode) {
        $html->appendContent(
            <<<HTML
        <div class="Episode">
            <p> {$html->escapeString($episode->getEpisodeNumber())} - {$html->escapeString($episode->getName())}</p>
        HTML
        );
        if (!empty($episode->getOverview())) {
            $html->appendContent("<p>{$html->escapeString($episode->getOverview())}</p>");
        }
        $html->appendContent("</div>");

    }
    echo $html->toHtml();
} catch(EntityNotFoundException $e) {
    http_response_code(404);
} catch(ParameterException $e) {
    http_response_code(400);
} catch(Exception $e) {
    http_response_code(500);
}
