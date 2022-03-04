<?php

/**
 * This file is part of the steam-search package.
 *
 * (c) Jeppe Vinkel Beier <jeppe@beiernet.dk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests;

use SteamSearch\Enums\MaxPrice;
use SteamSearch\Enums\SortBy;
use SteamSearch\QueryBuilder;
use PHPUnit\Framework\TestCase;

class QueryBuilderTest extends TestCase
{

    public function testSortByReviewScore()
    {
        $queryBuilder = QueryBuilder::create();
        $queryBuilder->sortByReviewScore();
        $this->assertEquals(SortBy::Reviews(), $queryBuilder->getSort());
    }

    public function testSortByPriceDescending()
    {
        $queryBuilder = QueryBuilder::create();
        $queryBuilder->sortByPriceDescending();
        $this->assertEquals(SortBy::PriceDesc(), $queryBuilder->getSort());
    }

    public function testSortByPriceAscending()
    {
        $queryBuilder = QueryBuilder::create();
        $queryBuilder->sortByPriceAscending();
        $this->assertEquals(SortBy::PriceAsc(), $queryBuilder->getSort());
    }

    public function testSortByName()
    {
        $queryBuilder = QueryBuilder::create();
        $queryBuilder->sortByName();
        $this->assertEquals(SortBy::Name(), $queryBuilder->getSort());
    }

    public function testSortByRelevance()
    {
        $queryBuilder = QueryBuilder::create();
        $queryBuilder->sortByRelevance();
        $this->assertEquals(SortBy::Relevance(), $queryBuilder->getSort());
    }

    public function testCreate()
    {
        $queryBuilder = QueryBuilder::create('test');
        $this->assertEquals('test', $queryBuilder->getTerm());
        $this->assertEquals(SortBy::Relevance(), $queryBuilder->getSort());
    }

    public function test__toString()
    {
        $queryBuilder = QueryBuilder::create('test');
        $this->assertEquals('https://store.steampowered.com/search/?term=test', (string)$queryBuilder);
    }

    public function testSearch()
    {
        $queryBuilder = QueryBuilder::create();
        $this->assertEquals('https://store.steampowered.com/search/?term=counter-strike', (string)$queryBuilder->search('counter-strike'));
    }

    public function testSortByReleaseDate()
    {
        $queryBuilder = QueryBuilder::create();
        $queryBuilder->sortByReleaseDate();
        $this->assertEquals(SortBy::Released(), $queryBuilder->getSort());
    }

    public function testInvalidMaxPrice()
    {
        $queryBuilder = QueryBuilder::create();
        $this->expectException(\InvalidArgumentException::class);
        $queryBuilder->maxPrice(12);
    }

    public function testMaxPrice()
    {
        $queryBuilder = QueryBuilder::create();;
        $this->assertEquals(MaxPrice::Free(), $queryBuilder->maxPrice(0)->getMaxPrice());
        $this->assertEquals(MaxPrice::Five(), $queryBuilder->maxPrice(5)->getMaxPrice());
        $this->assertEquals(MaxPrice::Ten(), $queryBuilder->maxPrice(10)->getMaxPrice());
        $this->assertEquals(MaxPrice::Fifteen(), $queryBuilder->maxPrice(15)->getMaxPrice());
        $this->assertEquals(MaxPrice::Twenty(), $queryBuilder->maxPrice(20)->getMaxPrice());
        $this->assertEquals(MaxPrice::TwentyFive(), $queryBuilder->maxPrice(25)->getMaxPrice());
        $this->assertEquals(MaxPrice::Thirty(), $queryBuilder->maxPrice(30)->getMaxPrice());
        $this->assertEquals(MaxPrice::ThirtyFive(), $queryBuilder->maxPrice(35)->getMaxPrice());
        $this->assertEquals(MaxPrice::Forty(), $queryBuilder->maxPrice(40)->getMaxPrice());
        $this->assertEquals(MaxPrice::FortyFive(), $queryBuilder->maxPrice(45)->getMaxPrice());
        $this->assertEquals(MaxPrice::Fifty(), $queryBuilder->maxPrice(50)->getMaxPrice());
        $this->assertEquals(MaxPrice::FiftyFive(), $queryBuilder->maxPrice(55)->getMaxPrice());
        $this->assertEquals(MaxPrice::Sixty(), $queryBuilder->maxPrice(60)->getMaxPrice());
        $this->assertEquals(MaxPrice::All(), $queryBuilder->maxPrice(null)->getMaxPrice());
        $this->assertEquals(MaxPrice::All(), $queryBuilder->maxPrice(-1)->getMaxPrice());
    }
}
