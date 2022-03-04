<?php

/**
 * This file is part of the steam-search package.
 *
 * (c) Jeppe Vinkel Beier <jeppe@beiernet.dk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Enums;

use SteamSearch\Enums\BaseEnum;
use PHPUnit\Framework\TestCase;
use SteamSearch\Enums\SortBy;

class BaseEnumTest extends TestCase
{

    public function testGetValue()
    {
        $released = SortBy::Released();
        $this->assertEquals('Released_DESC', $released->getValue());
    }

    public function testGetName()
    {
        $released = SortBy::Released();
        $this->assertEquals('Released', $released->getName());
    }

    public function testFromValue()
    {
        $released = SortBy::fromValue('Released_DESC');
        $this->assertEquals('Released_DESC', $released->getValue());
    }

    public function testFromName()
    {
        $released = SortBy::fromName('Released');
        $this->assertEquals('Released_DESC', $released->getValue());
    }

    public function testFromValueThrowsException()
    {
        $this->expectException(\OutOfRangeException::class);
        SortBy::fromValue('NotExisting');
    }

    public function testFromNameThrowsException()
    {
        $this->expectException(\OutOfRangeException::class);
        SortBy::fromName('NotExisting');
    }
}
