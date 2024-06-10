<?php

namespace Tests\Collection;

use Entity\Collection\EpisodeCollection;
use Entity\Episode;
use Entity\Exception\EntityNotFoundException;
use Tests\CrudTester;

class EpisodeCollectionCest
{
    public function findBySeasonId(CrudTester $I)
    {
        $expectedEps = [
            ['id' => 3869,'seasonId' => 208,'name' => 'La Grande Aventure de Bender','episodeNumber' => 1],
            ['id' => 3870,'seasonId' => 208,'name' => 'Everybody Loves Hypnotoad','episodeNumber' => 2],
            ['id' => 3871,'seasonId' => 208,'name' => 'Le Monstre au milliard de tentacules','episodeNumber' => 3],
            ['id' => 3872,'seasonId' => 208,'name' => 'The Lost Adventure','episodeNumber' => 4],
            ['id' => 3873,'seasonId' => 208,'name' => 'Prenez garde au seigneur des robots !','episodeNumber' => 5],
            ['id' => 3874,'seasonId' => 208,'name' => 'Vous prendrez bien un dernier vert ?','episodeNumber' => 6],
        ];
        $eps = EpisodeCollection::findBySeasonId(208);
        $I->assertCount(count($expectedEps), $eps);
        $I->assertContainsOnlyInstancesOf(Episode::class, $eps);
        foreach ($eps as $index => $ep) {
            $expectedEp = $expectedEps[$index];
            $I->assertEquals($expectedEp['id'], $ep->getId());
            $I->assertEquals($expectedEp['seasonId'], $ep->getSeasonId());
            $I->assertEquals($expectedEp['name'], $ep->getName());
            $I->assertEquals($expectedEp['episodeNumber'], $ep->getEpisodeNumber());
        }
    }

    public function findByIdThrowsExceptionIfSeasonDoesNotExist(CrudTester $I): void
    {
        $I->expectThrowable(EntityNotFoundException::class, function () {
            EpisodeCollection::findBySeasonId(PHP_INT_MAX);
        });
    }
}
