# Steam Search

[![Packagist Version](https://img.shields.io/packagist/v/jeppevinkel/steam-search)](https://packagist.org/packages/jeppevinkel/steam-search)
![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/jeppevinkel/steam-search)
[![Codecov](https://img.shields.io/codecov/c/github/jeppevinkel/steam-search)](https://app.codecov.io/gh/jeppevinkel/steam-search/)

Api for searching games from the Steam store.
This search API works by calling the regular steam store page and scraping the results from the page. It doesn't yet support scrolling the page, so it might be limited in the number of results per search query.

## Installation
Use [composer] to install the package.

```bash
composer require jeppevinkel/steam-search
```

## Usage
```php
use SteamSearch\SteamSearch;

$steamSearch = new SteamSearch();
$queryBuilder = QueryBuilder::create()
    ->search('counter-strike')
    ->sortByReleaseDate();
$result = $steamSearch->search($queryBuilder);

// Results can also be filtered by max price.
$queryBuilder = QueryBuilder::create()
    ->search('counter-strike')
    ->sortByReleaseDate()
    ->maxPrice(50);
// Valid values for maxPrice are:
// 0, 5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 55, 60
// To get all results, use maxPrice(-1), this is also the default value.
```

The result is an array of SearchResult objects.
They each have the following properties:
```php
public string $title;
public int $appId;
public string $url;
public ?Carbon $releaseDate;
public string $reviewSummary;
```

## Docs

[https://jeppevinkel.github.io/steam-search](https://jeppevinkel.github.io/steam-search/)

## Contributing
Pull requests are welcome. For design changes, please open an issue to discuss what you would like to change.

## License
[MIT]

[composer]: https://getcomposer.org/
[MIT]: https://opensource.org/licenses/MIT
