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

class MaxPrice extends BaseEnum
{
    public static function Free() { return self::_create('free'); }
    public static function Five() { return self::_create('5'); }
    public static function Ten() { return self::_create('10'); }
    public static function Fifteen() { return self::_create('15'); }
    public static function Twenty() { return self::_create('20'); }
    public static function TwentyFive() { return self::_create('25'); }
    public static function Thirty() { return self::_create('30'); }
    public static function ThirtyFive() { return self::_create('35'); }
    public static function Forty() { return self::_create('40'); }
    public static function FortyFive() { return self::_create('45'); }
    public static function Fifty() { return self::_create('50'); }
    public static function FiftyFive() { return self::_create('55'); }
    public static function Sixty() { return self::_create('60'); }
    public static function All() { return self::_create(''); }
}