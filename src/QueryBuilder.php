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

use SteamSearch\Enums\SortBy;
use SteamSearch\Models\VRSupport;

class QueryBuilder
{
    const STEAM_SEARCH_URL = 'https://store.steampowered.com/search/';

    private string $term = '';
    private Enums\SortBy $sort;
    private Enums\MaxPrice $maxPrice;
    private VRSupport $vrSupport;
    private bool $excludeVROnly = false;

    private function __construct()
    {
        $this->vrSupport = new VRSupport();
        $this->sort = SortBy::Relevance();
        $this->maxPrice = Enums\MaxPrice::All();
    }

    public function __toString(): string
    {
        return self::STEAM_SEARCH_URL . '?' . http_build_query([
                'term' => $this->term,
                'sort_by' => $this->sort,
                'max_price' => $this->maxPrice,
                'vrsupport' => $this->vrSupport->toQueryString(),
                'unvrsupport' => $this->excludeVROnly ? '401' : null,
            ]);
    }

    /**
     * Create a new QueryBuilder instance.
     * @param string $term
     * @return QueryBuilder
     */
    public static function create(string $term = ''): QueryBuilder
    {
        $instance = new self();
        return $instance->search($term);
    }

    /**
     * Set the search term.
     * @param string $term
     * @return $this
     */
    public function search(string $term): self
    {
        $this->term = $term;
        return $this;
    }

    /**
     * Default steam search sort order.
     * @return $this
     */
    public function sortByRelevance(): self
    {
        $this->sort = Enums\SortBy::Relevance();
        return $this;
    }

    /**
     * Sort by release date. Most recent results first.
     * @return $this
     */
    public function sortByReleaseDate(): self
    {
        $this->sort = Enums\SortBy::Released();
        return $this;
    }

    /**
     * Sort by name. Alphabetical order.
     * @return $this
     */
    public function sortByName(): self
    {
        $this->sort = Enums\SortBy::Name();
        return $this;
    }

    /**
     * Sort by price. Lowest price first.
     * @return $this
     */
    public function sortByPriceAscending(): self
    {
        $this->sort = Enums\SortBy::PriceAsc();
        return $this;
    }

    /**
     * Sort by price. Highest price first.
     * @return $this
     */
    public function sortByPriceDescending(): self
    {
        $this->sort = Enums\SortBy::PriceDesc();
        return $this;
    }

    /**
     * Sort by review score. Highest score first.
     * @return $this
     */
    public function sortByReviewScore(): self
    {
        $this->sort = Enums\SortBy::Reviews();
        return $this;
    }

    /**
     * Filter results to show titles that only support VR.
     * @return $this
     */
    public function vrOnly(): self
    {
        $this->vrSupport->setVrOnly(true);
        return $this;
    }

    /**
     * Filter results to show titles with VR support.
     * @return $this
     */
    public function vrSupported(): self
    {
        $this->vrSupport->setVrSupported(true);
        return $this;
    }

    /**
     * Filter results to show titles that support the Valve Index.
     * @return $this
     */
    public function vrValveIndex(): self
    {
        $this->vrSupport->setValveIndex(true);
        return $this;
    }

    /**
     * Filter results to show titles that support the HTC Vive.
     * @return $this
     */
    public function vrHtcVive(): self
    {
        $this->vrSupport->setHtcVive(true);
        return $this;
    }

    /**
     * Filter results to show titles that support the Oculus Rift.
     * @return $this
     */
    public function vrOculusRift(): self
    {
        $this->vrSupport->setOculusRift(true);
        return $this;
    }

    /**
     * Filter results to show titles that support Windows Mixed Reality.
     * @return $this
     */
    public function vrWindowsMixedReality(): self
    {
        $this->vrSupport->setWindowsMixedReality(true);
        return $this;
    }

    /**
     * Filter results to show titles that support tracked motion controllers.
     * @return $this
     */
    public function vrTrackedMotionControllers(): self
    {
        $this->vrSupport->setTrackedMotionControllers(true);
        return $this;
    }

    /**
     * Filter results to show titles that support gamepads.
     * @return $this
     */
    public function vrGamepad(): self
    {
        $this->vrSupport->setGamepad(true);
        return $this;
    }

    /**
     * Filter results to show titles that support keyboard and mouse.
     * @return $this
     */
    public function vrKeyboardMouse(): self
    {
        $this->vrSupport->setKeyboardMouse(true);
        return $this;
    }

    /**
     * Set the maximum price to search for.
     * @param integer $maxPrice
     * @return $this
     */
    public function maxPrice(int $maxPrice): self
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