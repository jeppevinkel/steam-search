# Steam Search

Api for searching games from the Steam store.

## Installation
Use [composer] to install the package.

```bash
composer require jeppevinkel/steam-search
```

## Usage
```php
use SteamSearch\SteamSearch;

$steamSearch = new SteamSearch();
$queryBuilder = QueryBuilder::create()->search('counter-strike')->sortByReleaseDate();
$result = $steamSearch->search($queryBuilder);
```

The result is an array of SearchResult objects.
They each have the following properties:
```php
public string $title;
public string $url;
public ?Carbon $releaseDate;
public string $reviewSummary;
```

## Contributing
Pull requests are welcome. For design changes, please open an issue to discuss what you would like to change.

## License
[MIT]

[composer]: https://getcomposer.org/
[MIT]: https://opensource.org/licenses/MIT