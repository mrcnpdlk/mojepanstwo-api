# mojepanstwo-api

API v3 for [https://mojepanstwo.pl](https://mojepanstwo.pl)


 ## Basic usage
 ### Client settings
 
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

