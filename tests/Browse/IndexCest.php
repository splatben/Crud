<?php

namespace Browse;

use Tests\BrowseTester;

class IndexCest
{
    public function checkAppWebPageHtmlStructure(BrowseTester $I): void
    {
        $I->amOnPage('/');
        $I->seeResponseCodeIs(200);
        $I->seeInTitle('Série Tv');
        $I->seeElement('.header');
        $I->seeElement('.header h1');
        $I->see('Série Tv', '.header h1');
        $I->seeElement('.content');
        $I->seeElement('.footer');
    }


    public function listAllShows(BrowseTester $I): void
    {
        $I->amOnPage('/');
        $I->seeResponseCodeIs(200);
        $I->see('Série Tv', 'h1');
        $I->seeElement('.content .list__show');
        $I->assertEquals(
            [
                'Friends',
                'Futurama',
                'Good Omens',
                'Hunters',
                'La caravane de l\'étrange'
            ],
            $I->grabMultiple('.content .show__name')
        );
    }

    public function clickOnArtistLink(BrowseTester $I): void
    {
        $I->amOnPage('/');
        $I->seeResponseCodeIs(200);
        $I->click('Friends');
        $I->seeInCurrentUrl('/tvshow.php?tvshowId=3');
    }
}
