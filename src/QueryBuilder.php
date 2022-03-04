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
    private Enums\MaxPrice $maxPrice;

    public function __toString(): string
    {
        return self::STEAM_SEARCH_URL . '?' . http_build_query([
            'term' => $this->term,
            'sort_by' => $this->sort,
            'max_price' => $this->maxPrice,
        ]);
    }

    public static function create($term = ''): self
    {
        $instance = new self();
        return $instance->search($term)->sortByRelevance()->maxPrice(null);
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

    /**
     * @param integer|null $maxPrice
     * @return $this
     */
    public function maxPrice(?int $maxPrice): self
    {
        switch ($maxPrice) {
            case 0:
                $this->maxPrice = Enums\MaxPrice::Free();
                break;
            case 5:
                $this->maxPrice = Enums\MaxPrice::Five();
                break;
            case 10:
                $this->maxPrice = Enums\MaxPrice::Ten();
                break;
            case 15:
                $this->maxPrice = Enums\MaxPrice::Fifteen();
                break;
            case 20:
                $this->maxPrice = Enums\MaxPrice::Twenty();
                break;
            case 25:
                $this->maxPrice = Enums\MaxPrice::TwentyFive();
                break;
            case 30:
                $this->maxPrice = Enums\MaxPrice::Thirty();
                break;
            case 35:
                $this->maxPrice = Enums\MaxPrice::ThirtyFive();
                break;
            case 40:
                $this->maxPrice = Enums\MaxPrice::Forty();
                break;
            case 45:
                $this->maxPrice = Enums\MaxPrice::FortyFive();
                break;
            case 50:
                $this->maxPrice = Enums\MaxPrice::Fifty();
                break;
            case 55:
                $this->maxPrice = Enums\MaxPrice::FiftyFive();
                break;
            case 60:
                $this->maxPrice = Enums\MaxPrice::Sixty();
                break;
            case -1:
                $this->maxPrice = Enums\MaxPrice::All();
                break;
            default:
                throw new \InvalidArgumentException('Invalid max price');
        }

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

    public function getMaxPrice(): Enums\MaxPrice
    {
        return $this->maxPrice;
    }
}