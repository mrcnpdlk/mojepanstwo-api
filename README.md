# mojepanstwo-api
API v3 serwisu [https://mojepanstwo.pl](https://mojepanstwo.pl)


 ## Basic usage
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

    $oApi = \mrcnpdlk\MojePanstwo\Api::create($oClient);

    $res = $oApi->getKrsEntity('0000359730',\mrcnpdlk\MojePanstwo\Model\KrsEntity::PULL_ALL);
    print_r($res);
```

 ## Response

```php
mrcnpdlk\MojePanstwo\Model\KrsEntity Object
(
    [id] => 359730
    [krs] => 0000359730
    [nip] => 1231216692
    [regon] => 
    [nazwa] => FUNDACJA EPAŃSTWO
    [nazwa_skrocona] => FUNDACJA EPAŃSTWO
    [adres] => ul.  PLISZKI, nr 2B, lok. 1, miejsc. ZGORZAŁA, kod 05-500, poczta MYSIADŁO, kraj POLSKA
    [wojewodztwo_id] => 7
    [powiat_id] => 220
    [gmina_id] => 995
    [miejscowosc_id] => 56068
    [kod_pocztowy_id] => 3530
    [adres_kod_pocztowy] => 05-500
    [adres_kraj] => Polska
    [adres_lokal] => 1
    [adres_miejscowosc] => Zgorzała
    [adres_numer] => 2B
    [adres_poczta] => Mysiadło
    [adres_ulica] => Pliszki
    [cel_dzialania] => WSPOMAGANIE ROZWOJU DEMOKRACJI POPRZEZ UPOWSZECHNIANIE PRAW OBYWATELA W ZAKRESIE DOSTĘPU DO INFORMACJI PUBLICZNEJ.
    [data_dokonania_wpisu] => 2017-02-07
    [data_ostatni_wpis] => 
    [data_rejestracji] => 2010-06-29
    [data_sprawdzenia] => 2017-09-28T17:54:55
    [dotacje_ue_beneficjent_id] => 
    [email] => HTTP://EPF.ORG.PL/
    [firma] => FUNDACJA EPAŃSTWO
    [forma_prawna_id] => 1
    [forma_prawna_str] => FUNDACJA
    [forma_prawna_typ_id] => 2
    [gpw] => 
    [gpw_spolka_id] => 
    [knf_ostrzezenie_id] => 
    [liczba_akcji_wszystkich_emisji] => 0
    [liczba_czlonkow_komitetu_zal] => 0
    [liczba_dzialalnosci] => 0
    [liczba_emisji_akcji] => 0
    [liczba_jedynych_akcjonariuszy] => 0
    [liczba_nadzorcow] => 3
    [liczba_oddzialow] => 0
    [liczba_prokurentow] => 0
    [liczba_reprezentantow] => 2
    [liczba_wspolnikow] => 0
    [liczba_zmian] => 0
    [liczba_zmian_umow] => 2
    [nazwa_organu_nadzoru] => RADA FUNDACJI
    [nazwa_organu_reprezentacji] => ZARZĄD FUNDACJI
    [nieprzedsiebiorca] => 1
    [numer_wpisu] => 9
    [opp] => 
    [ostatni_wpis_id] => 
    [oznaczenie_sadu] => SĄD REJONOWY DLA M. ST. WARSZAWY W WARSZAWIE, XIV WYDZIAŁ GOSPODARCZY KRAJOWEGO REJESTRU SĄDOWEGO
    [rejestr] => 2
    [rejestr_stowarzyszen] => 0
    [siedziba] => kraj POLSKA, woj. MAZOWIECKIE, powiat PIASECZYŃSKI, gmina LESZNOWOLA, miejsc. ZGORZAŁA
    [sposob_reprezentacji] => 1.OŚWIADCZENIA WOLI W IMIENIU FUNDACJI, W TYM W SPRAWACH MAJĄTKOWYCH SKŁADAĆ MOŻE KAŻDY CZŁONEK ZARZĄDU SAMODZIELNIE. 2.W SPRAWACH MAJĄTKOWYCH POWYŻEJ KWOTY 10000 ZŁ WYMAGANY JEST PODPIS DWÓCH CZŁONKÓW ZARZĄDU DZIAŁAJĄCYCH ŁĄCZNIE, W TYM PREZESA
    [sygnatura_akt] => WA.XIV NS-REJ.KRS/87/17/397
    [twitter_account_id] => 714
    [umowa_spolki_cywilnej] => 
    [wartosc_czesc_kapitalu_wplaconego] => 0
    [wartosc_kapital_docelowy] => 0
    [wartosc_kapital_zakladowy] => 0
    [wartosc_nominalna_akcji] => 0
    [wartosc_nominalna_podwyzszenia_kapitalu] => 0
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

