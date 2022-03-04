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

class QueryBuilder
{
    const STEAM_SEARCH_URL = 'https://store.steampowered.com/search/';

    private string $term = '';
    private Enums\SortBy $sort;

    public function __toString(): string
    {
        return self::STEAM_SEARCH_URL . '?term=' . $this->term . '&sort_by=' . $this->sort->getValue();
    }

    public static function create($term = ''): self
    {
        $instance = new self();
        return $instance->search($term)->sortByRelevance();
    }

    public function search(string $term): self
    {
        $this->term = $term;
        return $this;
    }

    public function sortByRelevance(): self
    {
        $this->sort = Enums\SortBy::Relevance();
        return $this;
    }

    public function sortByReleaseDate(): self
    {
        $this->sort = Enums\SortBy::Released();
        return $this;
    }

    public function sortByName(): self
    {
        $this->sort = Enums\SortBy::Name();
        return $this;
    }

    public function sortByPriceAscending(): self
    {
        $this->sort = Enums\SortBy::PriceAsc();
        return $this;
    }

    public function sortByPriceDescending(): self
    {
        $this->sort = Enums\SortBy::PriceDesc();
        return $this;
    }

    public function sortByReviewScore(): self
    {
        $this->sort = Enums\SortBy::Reviews();
        return $this;
    }

    public function getTerm(): string
    {
        return $this->term;
    }

    public function getSort(): Enums\SortBy
    {
        return $this->sort;
    }
}