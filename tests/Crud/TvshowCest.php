<?php

namespace Tests;

use Entity\Exception\EntityNotFoundException;
use Entity\Tvshow;
use Tests\CrudTester;

class TvshowCest
{
    public function findById(CrudTester $I)
    {
        $show = Tvshow::findById(3);
        $I->assertSame(3, $show->getId());
        $I->assertSame('Friends', $show->getName());
        $show = Tvshow::findById(25);
        $I->assertSame(25, $show->getId());
        $I->assertSame('Futurama', $show->getOriginalName());
    }

    public function findByIdThrowsExceptionIfTvshowDoesNotExist(CrudTester $I)
    {
        $I->expectThrowable(EntityNotFoundException::class, function () {
            Tvshow::findById(PHP_INT_MAX);
        });
    }
}
