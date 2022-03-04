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

use Goutte\Client;
use Carbon\Carbon;
use phpDocumentor\Reflection\Type;
use Symfony\Component\DomCrawler\Crawler;

class SteamSearch
{
    const STEAM_SEARCH_URL = 'https://store.steampowered.com/search/';

    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @param string|QueryBuilder $query
     * @return array<SearchResult>
     */
    public function Search(mixed $query): array
    {
        if ($query instanceof QueryBuilder) {
            $queryBuilder = $query;
        } elseif (is_string($query)) {
            $queryBuilder = QueryBuilder::create()->search($query);
        } else {
            throw new \InvalidArgumentException('Query must be either a string or a QueryBuilder');
        }
        $crawler = $this->client->request('GET', $queryBuilder);

        $results = [];
        $crawler->filter('div#search_resultsRows a')->each(function (Crawler $game) use (&$results) {
            $url = $game->attr('href');
            $title = $game->filter('div.responsive_search_name_combined div.search_name span.title')->text();
            $release = $game->filter('div.responsive_search_name_combined div.search_released')->text('');
            $reviewAttributes = $game->filter('div.responsive_search_name_combined div.search_reviewscore span')->extract(['data-tooltip-html']);
            $review = $reviewAttributes[0] ?? '';
            $review = str_replace('<br>', ', ', $review);

            try {
                $release = Carbon::parse($release);
            } catch (\Exception $e) {
                $release = null;
            }

            $searchResult = new SearchResult($title, $url, $release, $review);

            $results[] = $searchResult;
        });

        return $results;
    }
}