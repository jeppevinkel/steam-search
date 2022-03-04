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

use Carbon\Carbon;
use SteamSearch\QueryBuilder;
use SteamSearch\SteamSearch;
use PHPUnit\Framework\TestCase;

class SteamSearchTest extends TestCase
{

    public function testSearch()
    {
        $steamSearch = new SteamSearch();
        $queryBuilder = QueryBuilder::create()->search('counter-strike');
        $result = $steamSearch->search($queryBuilder);

        $this->assertIsArray($result);
        $this->assertIsString($result[0]->title);
        $this->assertIsString($result[0]->url);
        $this->assertEquals('Counter-Strike: Global Offensive', $result[0]->title, 'Title is not equal');

        echo PHP_EOL . $result[0]->releaseDate . PHP_EOL;
        var_dump($result[0]);

        $this->assertEquals(Carbon::createFromFormat('!d M, Y', '21 Aug, 2012'), $result[0]->releaseDate, 'Dates are not equal');
    }
}
