<?php

namespace Crud\Collection;

use Entity\Collection\TvshowCollection;
use Entity\Exception\EntityNotFoundException;
use Entity\Tvshow;
use Tests\CrudTester;

class tvShowCollectionCest
{
    public function findByGenreId(CrudTester $I): void
    {
        $expectedTvShows = [
            ['id' => 25,'name' => 'Futurama','OriginalName' => 'Futurama','homepage' => 'http://www.comedycentral.com/shows/futurama','posterid' => 231],
        ];
        $tvShows = TvshowCollection::findByGenreId(1);
        $I->assertCount(count($expectedTvShows), $tvShows);
        $I->assertContainsOnlyInstancesOf(Tvshow::class, $tvShows);
        foreach ($tvShows as $index => $tvShow) {
            $expectedTvShow = $expectedTvShows[$index];
            $I->assertEquals($expectedTvShow['id'], $tvShow->getId());
            $I->assertEquals($expectedTvShow['name'], $tvShow->getName());
            $I->assertEquals($expectedTvShow['OriginalName'], $tvShow->getOriginalName());
            $I->assertEquals($expectedTvShow['homepage'], $tvShow->getHomepage());
            $I->assertEquals($expectedTvShow['posterid'], $tvShow->getPosterId());
        }
    }

    public function findByIdThrowsExceptionIfGenreDoesNotExist(CrudTester $I): void
    {
        $I->expectThrowable(EntityNotFoundException::class, function () {
            TvshowCollection::findByGenreId(PHP_INT_MAX);
        });
    }
}
