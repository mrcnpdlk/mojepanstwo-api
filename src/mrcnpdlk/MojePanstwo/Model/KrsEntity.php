<?php
/**
 * MOJEPANSTWO-API
 *
 * Copyright © 2017 pudelek.org.pl
 *
 * @license MIT License (MIT)
 *
 * For the full copyright and license information, please view source file
 * that is bundled with this package in the file LICENSE
 *
 * @author  Marcin Pudełek <marcin@pudelek.org.pl>
 */

/**
 * Created by Marcin.
 * Date: 28.10.2017
 * Time: 19:59
 */
declare (strict_types=1);

namespace mrcnpdlk\MojePanstwo\Model;


class KrsEntity extends ModelAbstract
{
    const CONTEXT = 'krs_podmioty';

    /**
     * id
     **/
    public $id;
    /**
     * krs
     **/
    public $krs;
    /**
     * nip
     **/
    public $nip;
    /**
     * regon
     **/
    public $regon;
    /**
     * nazwa
     **/
    public $nazwa;
    /**
     * nazwa_skrocona
     **/
    public $nazwa_skrocona;
    /**
     * adres
     **/
    public $adres;
    /**
     * wojewodztwo_id
     **/
    public $wojewodztwo_id;
    /**
     * powiat_id
     **/
    public $powiat_id;
    /**
     * gmina_id
     **/
    public $gmina_id;
    /**
     * miejscowosc_id
     **/
    public $miejscowosc_id;
    /**
     * kod_pocztowy_id
     **/
    public $kod_pocztowy_id;
    /**
     * adres_kod_pocztowy
     **/
    public $adres_kod_pocztowy;
    /**
     * adres_kraj
     **/
    public $adres_kraj;
    /**
     * adres_lokal
     **/
    public $adres_lokal;
    /**
     * adres_miejscowosc
     **/
    public $adres_miejscowosc;
    /**
     * adres_numer
     **/
    public $adres_numer;
    /**
     * adres_poczta
     **/
    public $adres_poczta;
    /**
     * adres_ulica
     **/
    public $adres_ulica;
    /**
     * cel_dzialania
     **/
    public $cel_dzialania;
    /**
     * data_dokonania_wpisu
     **/
    public $data_dokonania_wpisu;
    /**
     * data_ostatni_wpis
     **/
    public $data_ostatni_wpis;
    /**
     * data_rejestracji
     **/
    public $data_rejestracji;
    /**
     * data_sprawdzenia
     **/
    public $data_sprawdzenia;
    /**
     * dotacje_ue_beneficjent_id
     **/
    public $dotacje_ue_beneficjent_id;
    /**
     * email
     **/
    public $email;
    /**
     * firma
     **/
    public $firma;
    /**
     * forma_prawna_id
     **/
    public $forma_prawna_id;
    /**
     * forma_prawna_str
     **/
    public $forma_prawna_str;
    /**
     * forma_prawna_typ_id
     **/
    public $forma_prawna_typ_id;

    /**
     * gpw_spolka_id
     **/
    public $gpw_spolka_id;

    /**
     * knf_ostrzezenie_id
     **/
    public $knf_ostrzezenie_id;
    /**
     * liczba_akcji_wszystkich_emisji
     **/
    public $liczba_akcji_wszystkich_emisji;
    /**
     * liczba_czlonkow_komitetu_zal
     **/
    public $liczba_czlonkow_komitetu_zal;
    /**
     * liczba_dzialalnosci
     **/
    public $liczba_dzialalnosci;
    /**
     * liczba_emisji_akcji
     **/
    public $liczba_emisji_akcji;
    /**
     * liczba_jedynych_akcjonariuszy
     **/
    public $liczba_jedynych_akcjonariuszy;
    /**
     * liczba_nadzorcow
     **/
    public $liczba_nadzorcow;
    /**
     * liczba_oddzialow
     **/
    public $liczba_oddzialow;
    /**
     * liczba_prokurentow
     **/
    public $liczba_prokurentow;
    /**
     * liczba_reprezentantow
     **/
    public $liczba_reprezentantow;
    /**
     * liczba_wspolnikow
     **/
    public $liczba_wspolnikow;
    /**
     * liczba_zmian
     **/
    public $liczba_zmian;
    /**
     * liczba_zmian_umow
     **/
    public $liczba_zmian_umow;
    /**
     * nazwa_organu_nadzoru
     **/
    public $nazwa_organu_nadzoru;
    /**
     * nazwa_organu_reprezentacji
     **/
    public $nazwa_organu_reprezentacji;
    /**
     * nieprzedsiebiorca
     **/
    public $nieprzedsiebiorca;

    /**
     * numer_wpisu
     **/
    public $numer_wpisu;
    /**
     * opp
     **/
    public $opp;
    /**
     * ostatni_wpis_id
     **/
    public $ostatni_wpis_id;
    /**
     * oznaczenie_sadu
     **/
    public $oznaczenie_sadu;
    /**
     * rejestr
     **/
    public $rejestr;
    /**
     * rejestr_stowarzyszen
     **/
    public $rejestr_stowarzyszen;
    /**
     * siedziba
     **/
    public $siedziba;
    /**
     * sposob_reprezentacji
     **/
    public $sposob_reprezentacji;
    /**
     * sygnatura_akt
     **/
    public $sygnatura_akt;
    /**
     * twitter_account_id
     **/
    public $twitter_account_id;
    /**
     * umowa_spolki_cywilnej
     **/
    public $umowa_spolki_cywilnej;
    /**
     * wartosc_czesc_kapitalu_wplaconego
     **/
    public $wartosc_czesc_kapitalu_wplaconego;
    /**
     * wartosc_kapital_docelowy
     **/
    public $wartosc_kapital_docelowy;
    /**
     * wartosc_kapital_zakladowy
     **/
    public $wartosc_kapital_zakladowy;
    /**
     * wartosc_nominalna_akcji
     **/
    public $wartosc_nominalna_akcji;
    /**
     * wartosc_nominalna_podwyzszenia_kapitalu
     **/
    public $wartosc_nominalna_podwyzszenia_kapitalu;
    /**
     * wczesniejsza_rejestracja_str
     **/
    public $wczesniejsza_rejestracja_str;
    /**
     * www
     **/
    public $www;
    /**
     * wykreslony
     **/
    public $wykreslony;

    public function __construct(\stdClass $oData = null)
    {
        parent::__construct($oData);
        if ($oData) {

            $this->wojewodztwo_id            = $this->convertToId($this->wojewodztwo_id);
            $this->powiat_id                 = $this->convertToId($this->powiat_id);
            $this->gmina_id                  = $this->convertToId($this->gmina_id);
            $this->miejscowosc_id            = $this->convertToId($this->miejscowosc_id);
            $this->kod_pocztowy_id           = $this->convertToId($this->kod_pocztowy_id);
            $this->forma_prawna_id           = $this->convertToId($this->forma_prawna_id);
            $this->forma_prawna_typ_id       = $this->convertToId($this->forma_prawna_typ_id);
            $this->gpw_spolka_id             = $this->convertToId($this->gpw_spolka_id);
            $this->knf_ostrzezenie_id        = $this->convertToId($this->knf_ostrzezenie_id);
            $this->dotacje_ue_beneficjent_id = $this->convertToId($this->dotacje_ue_beneficjent_id);
            $this->opp                       = $this->convertToId($this->opp);
            $this->ostatni_wpis_id           = $this->convertToId($this->ostatni_wpis_id);

            $this->regon = $this->regon === '0' ? null : $this->regon;


        }
    }
}
