<?php

/**
 * This file is part of the steam-search package.
 *
 * (c) Jeppe Vinkel Beier <jeppe@beiernet.dk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SteamSearch\Enums;

final class SortBy extends BaseEnum
{
    public static function Relevance() { return self::_create(''); }
    public static function Released() { return self::_create('Released_DESC'); }
    public static function Name() { return self::_create('Name_ASC'); }
    public static function PriceAsc() { return self::_create('Price_ASC'); }
    public static function PriceDesc() { return self::_create('Price_DESC'); }
    public static function Reviews() { return self::_create('Reviews_DESC'); }
}