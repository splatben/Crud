<?php

use Entity\Season;
use Entity\Tvshow;
use Exception\ParameterException;
use Html\AppWebPage;

try{
    if (isset($_Get['seasonId'])&&!empty($_GET['seasonId'])&&ctype_digit($_Get['seasonId'])){
    $seasonId = $_Get['seasonId'];
    }else{
        throw new ParameterException();
    }
    $season = Season::findById($seasonId);
    $nomSerie = Tvshow::findById($season->getTvShowId())->getName();
    $html = new AppWebPage("Série Tv : {$nomSerie} \n {$season->getName()}");
    $html->appendCss(<<<CSS
    .Saison{
    display: flex;
    flex-flow: row nowrap;
    }
    .Titre{
    display:flex;
    justify-content: flex-end;
    }
CSS
);
    $html->appendContent(<<<HTML
<div class = "Saison">
   <img src = "poster.php?posterId = {$season->getPosterId()}">
   <p class = "Titre">{$season->getName()}</p>
   <p class = "Titre">$nomSerie</p>
</div>
HTML
);
    foreach($season->getEpisodes() as $episode){
        $html->appendContent(<<<HTML
<div class="Episode">
    <p> {$episode->getEpisodeNumber()} - {$episode->getEpisodeName()}</p>
    <br>
    <p> {$episode->getOverview()}</p>
</div>
HTML
);
    }
}