<?php

namespace Crud;

use Entity\Exception\EntityNotFoundException;
use Entity\Season;
use Tests\CrudTester;

class SeasonCest
{
    public function findById(CrudTester $I): void
    {
        $seas = Season::findById(13);
        $I->assertSame(13, $seas->getId());
        $I->assertSame(3, $seas->getTvShowId());
        $I->assertSame('Épisodes spéciaux', $seas->getName());
        $I->assertSame(2147483647, $seas->getSeasonNumber());
        $I->assertSame(16, $seas->getPosterId());
    }

    public function findByIdThrowsExceptionIfSeasonDoesNotExist(CrudTester $I): void
    {
        $I->expectThrowable(EntityNotFoundException::class, function () {
            Season::findById(PHP_INT_MAX);
        });
    }

    public function getPoster(CrudTester $I): void
    {
        $show = Season::findById(13);

        $I->assertSame("http://localhost:8000/poster.php?posterId=16", $show->getPoster());
    }

}
