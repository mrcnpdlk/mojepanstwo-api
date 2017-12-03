[![Latest Stable Version](https://img.shields.io/github/release/mrcnpdlk/mojepanstwo-api.svg)](https://packagist.org/packages/mrcnpdlk/mojepanstwo-api)
[![Latest Unstable Version](https://poser.pugx.org/mrcnpdlk/mojepanstwo-api/v/unstable.png)](https://packagist.org/packages/mrcnpdlk/mojepanstwo-api)
[![Total Downloads](https://img.shields.io/packagist/dt/mrcnpdlk/mojepanstwo-api.svg)](https://packagist.org/packages/mrcnpdlk/mojepanstwo-api)
[![Monthly Downloads](https://img.shields.io/packagist/dm/mrcnpdlk/mojepanstwo-api.svg)](https://packagist.org/packages/mrcnpdlk/mojepanstwo-api)
[![License](https://img.shields.io/packagist/l/mrcnpdlk/mojepanstwo-api.svg)](https://packagist.org/packages/mrcnpdlk/mojepanstwo-api)    

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/mrcnpdlk/mojepanstwo-api/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mrcnpdlk/mojepanstwo-api/?branch=master) 
[![Build Status](https://scrutinizer-ci.com/g/mrcnpdlk/mojepanstwo-api/badges/build.png?b=master)](https://scrutinizer-ci.com/g/mrcnpdlk/mojepanstwo-api/build-status/master)
[![Code Coverage](https://scrutinizer-ci.com/g/mrcnpdlk/mojepanstwo-api/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/mrcnpdlk/mojepanstwo-api/?branch=master)

[![Maintainability](https://api.codeclimate.com/v1/badges/83c5e3020d1e60cfd143/maintainability)](https://codeclimate.com/github/mrcnpdlk/mojepanstwo-api/maintainability)


# mojepanstwo-api

API v3 for [https://mojepanstwo.pl](https://mojepanstwo.pl)

## Api coverage

  | Lp 	| Method name  	        | Returned type   	|
  |:---:|:---	                |:---	            |
  |  1 	|   getCommune	        |Commune   	        |
  |  2 	|   getDistrict	        |District   	    |
  |  3 	|   getProvince	        |Province   	    |
  |  4 	|   getKrsEntityType    |KrsEntityType   	|
  |  5 	|   getKrsEntity	    |KrsEntity   	    |
  |  6 	|   getKrsPerson	    |KrsPerson   	    |
  |  7 	|   searchCommune	    |QueryBuilder   	|
  |  8 	|   searchDistrict	    |QueryBuilder   	|
  |  9 	|   searchProvince	    |QueryBuilder   	|
  |  10	|   searchKrsEntityType	|QueryBuilder   	|
  |  11 |   searchKrsEntity	    |QueryBuilder   	|
  |  12 |   searchKrsPerson	    |QueryBuilder   	|

For methods returned `QueryBuilder` object, you are able to use below actions to specify your own conditions:

  | Lp 	| Method name  	        | Returned type   	    |
  |:---:|:---	                |:---	                |
  |  1 	|   page()	            |QueryBuilder           |
  |  2 	|   where()	            |QueryBuilder 	        |
  |  3 	|   whereQ()	        |QueryBuilder 	        |
  |  4 	|   orderBy()	        |QueryBuilder  	        |
  |  5 	|   limit()             |QueryBuilder   	    |
  |  6 	|   get()       	    |SearchResponse	        |

## Basic usage
### Client settings
Library supports Cache bundles based on [PSR-16](http://www.php-fig.org/psr/psr-16/) standard.
 
For below example was used [phpfastcache/phpfastcache](https://github.com/PHPSocialNetwork/phpfastcache).
`phpfastcache/phpfastcache` supports a lot of endpoints, i.e. `Files`, `Sqlite`, `Redis` and many other. 
More information about using cache and configuration it you can find in this [Wiki](https://github.com/PHPSocialNetwork/phpfastcache/wiki). 
Library also supports logging packages based on [PSR-3](http://www.php-fig.org/psr/psr-3/) standard, i.e. very popular
[monolog/monolog](https://github.com/Seldaek/monolog).

Pushing Log and Cache instances. Not required, but suggested for better performance.
 
```php
    $oInstanceCacheRedis = new \phpFastCache\Helper\Psr16Adapter(
        'redis',
        [
            "host"                => null, // default localhost
            "port"                => null, // default 6379
            'defaultTtl'          => 3600 * 24, // 24h
            'ignoreSymfonyNotice' => true,
        ]);

    $oInstanceLogger = new \Monolog\Logger('MOJEPANSTWO');
    $oInstanceLogger->pushHandler(new \Monolog\Handler\ErrorLogHandler(
            \Monolog\Handler\ErrorLogHandler::OPERATING_SYSTEM,
            \Psr\Log\LogLevel::DEBUG
        )
    );


    $oClient = new \mrcnpdlk\MojePanstwo\Client();
    $oClient->setCacheInstance($oInstanceCacheRedis)
            ->setLoggerInstance($oInstanceLogger)
    ;
```

### Getting KRS Entity
#### Request
##### Available pull flags
  - `KrsEntity::PULL_NONE`
  - `KrsEntity::PULL_COMPANIES` - Layer `firmy`
  - `KrsEntity::PULL_DEPARTMENTS` - Layer `oddzialy`
  - `KrsEntity::PULL_PARTNERS` - Layer `wspolnicy`
  - `KrsEntity::PULL_PKDS` - Layer `dzialalnosci`
  - `KrsEntity::PULL_SHARES` - Layer `emisje_akcji`
  - `KrsEntity::PULL_PERSON_REPRESENTATION` - Layer `reprezentacja`
  - `KrsEntity::PULL_PERSON_SUPERVISION` - Layer `nadzor`
  - `KrsEntity::PULL_PERSON_PROXY` - Layer `prokurenci`
  - `KrsEntity::PULL_PERSON_FOUNDING` - Layer `komitetZalozycielski`
  - `KrsEntity::PULL_ALL` - All layers
```php
    $oApi = \mrcnpdlk\MojePanstwo\Api::create($oClient);

    $res = $oApi->getKrsEntity('0000359730',\mrcnpdlk\MojePanstwo\Model\KrsEntity::PULL_ALL);
    print_r($res);
```

#### Response

```php
mrcnpdlk\MojePanstwo\Model\KrsEntity Object
(
    [id] => 359730
    [krs] => 0000359730
    [nip] => 1231216692
    [regon] => 
    [nazwa] => FUNDACJA EPAŃSTWO
    .
    .
    [wczesniejsza_rejestracja_str] => 
    [www] => BIURO @EPF.ORG.PL
    [wykreslony] => 0
    [dzialalnosci] => Array
        (
        )
    [emisje_akcji] => Array
        (
        )
    [firmy] => Array
        (
        )
    [nadzor] => Array
        (
            [0] => mrcnpdlk\MojePanstwo\Model\KrsEntity\Person Object
                (
                    [osoba_id] => 418604
                    [nazwa] => XXXXX Michał Grzegorz
                    [data_urodzenia] => 1977-03-12
                    [privacy_level] => 0
                    [funkcja] => 
                )
            [1] => mrcnpdlk\MojePanstwo\Model\KrsEntity\Person Object
                (
                    [osoba_id] => 447892
                    [nazwa] => XXXXX Maciej Rafał
                    [data_urodzenia] => 1977-07-21
                    [privacy_level] => 0
                    [funkcja] => 
                )
            [2] => mrcnpdlk\MojePanstwo\Model\KrsEntity\Person Object
                (
                    [osoba_id] => 8972
                    [nazwa] => XXXXX Jakub Mirosław
                    [data_urodzenia] => 1985-09-23
                    [privacy_level] => 0
                    [funkcja] => 
                )
        )
    [prokurenci] => Array
        (
        )
    [reprezentacja] => Array
        (
            [0] => mrcnpdlk\MojePanstwo\Model\KrsEntity\Person Object
                (
                    [osoba_id] => 8971
                    [nazwa] => XXXXX Daniel
                    [data_urodzenia] => 1984-04-03
                    [privacy_level] => 0
                    [funkcja] => Prezes Zarządu
                )
            [1] => mrcnpdlk\MojePanstwo\Model\KrsEntity\Person Object
                (
                    [osoba_id] => 146037
                    [nazwa] => XXXXXX Krzysztof Kazimierz
                    [data_urodzenia] => 1981-12-03
                    [privacy_level] => 0
                    [funkcja] => Członek Zarządu
                )
        )
    [wspolnicy] => Array
        (
        )
    [oddzialy] => Array
        (
        )
)
```

### Searching KRS Entity
#### Request
Calling `searchKrsEntity()` method returns QueryBuilder instance, additional functions as `limit()`, `where()`, `page()` are available.
At the end call method `get()` to receive `SearchResponse` object.

```php
    $res = $oApi->searchKrsEntity()
                ->limit(2)
                ->where('wojewodztwo_id', 2)
                ->page(2)
                ->get()
    ;
    print_r($res);
```

#### Response
 ```php
mrcnpdlk\MojePanstwo\Model\SearchResponse Object
(
    [count] => 21102
    [took] => 340
    [links] => mrcnpdlk\MojePanstwo\Model\SearchResponseLinks Object
        (
            [self] => https://api-v3.mojepanstwo.pl/dane/krs_podmioty/?conditions%5Bkrs_podmioty.wojewodztwo_id%5D=2&page=2&limit=2&_type=objects
            [first] => https://api-v3.mojepanstwo.pl/dane/krs_podmioty/?conditions%5Bkrs_podmioty.wojewodztwo_id%5D=2&page=1&limit=2&_type=objects
            [next] => https://api-v3.mojepanstwo.pl/dane/krs_podmioty/?conditions%5Bkrs_podmioty.wojewodztwo_id%5D=2&page=3&limit=2&_type=objects
            [last] => https://api-v3.mojepanstwo.pl/dane/krs_podmioty/?conditions%5Bkrs_podmioty.wojewodztwo_id%5D=2&page=10551&limit=2&_type=objects
        )

    [items] => Array
        (
            [0] => mrcnpdlk\MojePanstwo\Model\SearchResponseItem Object
                (
                    [id] => 699600
                    [dataset] => krs_podmioty
                    [url] => https://api-v3.mojepanstwo.pl/dane/krs_podmioty/699600
                    [mp_url] => https://mojepanstwo.pl/dane/krs_podmioty/699600
                    [schema_url] => https://api-v3.mojepanstwo.pl/schemas/dane/krs_podmioty.json
                    [global_id] => 58872094
                    [slug] => correct-context
                    [score] => 
                    [data] => mrcnpdlk\MojePanstwo\Model\KrsEntity Object
                        (
                            [id] => 699600
                            [krs] => 0000699600
                            [nip] => 9532727782
                            [regon] => 
                            [nazwa] => CORRECT CONTEXT SPÓŁKA Z OGRANICZONĄ ODPOWIEDZIALNOŚCIĄ
                            [nazwa_skrocona] => CORRECT CONTEXT
                            .
                            .
                            .
                        )
                )
                .
                .
                .
        )
)
```

### Getting KRS Person
#### Request
##### Available pull flags
  - `KrsPerson::PULL_NONE`
  - `KrsPerson::PULL_KRS_ENTITIES`
  - `KrsPerson::PULL_ALL`

```php
    $oApi = \mrcnpdlk\MojePanstwo\Api::create($oClient);

    $res = $oApi->getKrsPerson('1491928',\mrcnpdlk\MojePanstwo\Model\KrsPerson::PULL_ALL);
    print_r($res);
```

### Searching KRS Person
#### Request
Calling `searchKrsPerson()` method returns QueryBuilder instance, additional functions as `limit()`, `where()`/`whereQ()`, `page()` are available.
At the end call method `get()` to receive `SearchResponse` object.
```php
    $res = $oApi->searchKrsPerson()
                ->whereQ('Jan Nowak')
                ->get()
    ;
    print_r($res);
```

