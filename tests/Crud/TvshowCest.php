<?php

namespace Tests;

use Entity\Exception\EntityNotFoundException;
use Entity\Tvshow;
use Tests\CrudTester;

class TvshowCest
{
    public function findById(CrudTester $I): void
    {
        $show = Tvshow::findById(3);
        $I->assertSame(3, $show->getId());
        $I->assertSame('Friends', $show->getName());
        $show = Tvshow::findById(25);
        $I->assertSame(25, $show->getId());
        $I->assertSame('Futurama', $show->getOriginalName());
    }

    public function findByIdThrowsExceptionIfTvshowDoesNotExist(CrudTester $I): void
    {
        $I->expectThrowable(EntityNotFoundException::class, function () {
            Tvshow::findById(PHP_INT_MAX);
        });
    }

    public function getPoster(CrudTester $I): void
    {
        $show = Tvshow::findById(3);
        $poster = $show->getPoster();
        $I->assertSame(15, $poster->getId());
        $I->assertSame(file_get_contents(codecept_data_dir().'/Poster/posterTest.jpeg'), $poster->getJpeg());

    }

}
