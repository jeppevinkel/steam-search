<?php

/**
 * This file is part of the steam-search package.
 *
 * (c) Jeppe Vinkel Beier <jeppe@beiernet.dk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SteamSearch;

use Carbon\Carbon;

class SearchResult
{
    /**
     * @var string
     */
    public string $title;

    /**
     * @var integer
     */
    public int $appId;

    /**
     * @var string
     */
    public string $url;

    /**
     * @var Carbon|null
     */
    public ?Carbon $releaseDate;

    /**
     * @var string
     */
    public string $reviewSummary;

    public function __construct(string $title, string $url, ?Carbon $releaseDate, string $reviewSummary, int $appId)
    {
        $this->title = $title;
        $this->url = $url;
        $this->releaseDate = $releaseDate;
        $this->reviewSummary = $reviewSummary;
        $this->appId = $appId;
    }
}