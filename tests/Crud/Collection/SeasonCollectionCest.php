<?php

namespace Tests\Collection;

use Entity\Collection\SeasonCollection;
use Entity\Season;
use Tests\CrudTester;

class SeasonCollectionCest
{
    public function findByTvShowId(CrudTester $I)
    {
        $expectedSeasons = [
            ['id' => 418,'tvshowid' => 57,'name' => 'Saison 1','seasonnumber' => 1,'posterid' => 467],
            ['id' => 419,'tvshowid' => 57,'name' => 'Saison 2','seasonnumber' => 2,'posterid' => 468]
        ];
        $Seasons = SeasonCollection::findByTvShowId(57);
        $I->assertCount(count($expectedSeasons), $Seasons);
        $I->assertContainsOnlyInstancesOf(Season::class, $Seasons);
        foreach ($Seasons as $index => $season) {
            $expectedSeason = $expectedSeasons[$index];
            $I->assertEquals($expectedSeason['id'], $season->getId());
            $I->assertEquals($expectedSeason['tvshowid'], $season->getTvShowId());
            $I->assertEquals($expectedSeason['name'], $season->getName());
            $I->assertEquals($expectedSeason['seasonnumber'], $season->getSeasonNumber());
            $I->assertEquals($expectedSeason['posterid'], $season->getPosterId());
        }
    }
}
