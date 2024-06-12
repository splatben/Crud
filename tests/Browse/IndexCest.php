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
}
