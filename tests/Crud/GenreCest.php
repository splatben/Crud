<?php

namespace Tests;

use Entity\Exception\EntityNotFoundException;
use Entity\Genre;
use Tests\CrudTester;

class GenreCest
{
    public function findById(CrudTester $I): void
    {
        $genre = Genre::findById(1);
        $I->assertSame(1, $genre->getId());
        $I->assertSame('Action & Adventure', $genre->getName());

    }
    public function findByIdThrowsExceptionIfGenreDoesNotExist(CrudTester $I): void
    {
        $I->expectThrowable(EntityNotFoundException::class, function () {
            Genre::findById(PHP_INT_MAX);
        });
    }
}
