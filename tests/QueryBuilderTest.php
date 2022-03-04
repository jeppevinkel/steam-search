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
        $this->assertEquals('https://store.steampowered.com/search/?term=test&sort_by=', (string)$queryBuilder);
    }

    public function testSearch()
    {
        $queryBuilder = QueryBuilder::create();
        $this->assertEquals('https://store.steampowered.com/search/?term=counter-strike&sort_by=', (string)$queryBuilder->search('counter-strike'));
    }

    public function testSortByReleaseDate()
    {
        $queryBuilder = QueryBuilder::create();
        $queryBuilder->sortByReleaseDate();
        $this->assertEquals(SortBy::Released(), $queryBuilder->getSort());
    }
}
