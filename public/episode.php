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
    .Saison,.Episode{
    display: flex;
    flex-flow: row wrap;
    border : 2px solid #456969;
    margin: 4px;
    background-color: #5e9393;  
    }
    .Titre{
    align-self: flex-end;
    font-size: 20px;
    }
    .Episode{
    flex-grow: 1;
    border-radius : 20px;
    }
    .Saison{
    font-size: 30px;
    padding : 5px;
    flex-grow: 2;    
    }
    .info{
    padding:  10px;
    display: flex;
    flex-direction: column;
}
CSS
    );
    $html->appendContent(
        <<<HTML
<div class = "Saison">
   <img src = "poster.php?posterId={$season->getPosterId()}">
   <div class = "Info">
   <p class ="Titre">{$html->escapeString($season->getName())} </p>
   <p class ="Titre">$seriesName</p>
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
        if (!empty($episode->getOverview())){
            $html->appendContent("<p>{$episode->getOverview()}</p>");
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
