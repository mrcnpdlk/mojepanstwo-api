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

declare (strict_types=1);

namespace mrcnpdlk\MojePanstwo\Model;


use mrcnpdlk\MojePanstwo\Api;
use mrcnpdlk\MojePanstwo\Model\KrsEntity\Companies;
use mrcnpdlk\MojePanstwo\Model\KrsEntity\Department;
use mrcnpdlk\MojePanstwo\Model\KrsEntity\Partner;
use mrcnpdlk\MojePanstwo\Model\KrsEntity\Person;
use mrcnpdlk\MojePanstwo\Model\KrsEntity\Pkd;
use mrcnpdlk\MojePanstwo\Model\KrsEntity\Share;

class KrsEntity extends ModelAbstract
{
    const CONTEXT                    = 'krs_podmioty';
    const PULL_NONE                  = 0;
    const PULL_COMPANIES             = 1;
    const PULL_DEPARTMENTS           = 2;
    const PULL_PARTNERS              = 4;
    const PULL_PKDS                  = 8;
    const PULL_SHARES                = 16;
    const PULL_PERSON_REPRESENTATION = 32;
    const PULL_PERSON_SUPERVISION    = 64;
    const PULL_PERSON_PROXY          = 128;
    const PULL_PERSON_FOUNDING       = 256;
    const PULL_ALL                   = 511;


    /**
     * Krs jako int
     *
     * @var integer
     **/
    public $id;
    /**
     * krs
     *
     * @var string
     **/
    public $krs;
    /**
     * nip
     *
     * @var string|null
     **/
    public $nip;
    /**
     * regon
     *
     * @var string|null
     **/
    public $regon;
    /**
     * nazwa
     *
     * @var string
     **/
    public $nazwa;
    /**
     * nazwa_skrocona
     *
     * @var string
     **/
    public $nazwa_skrocona;
    /**
     * adres
     *
     * @var string
     **/
    public $adres;
    /**
     * wojewodztwo_id
     *
     * @var integer
     **/
    public $wojewodztwo_id;
    /**
     * powiat_id
     *
     * @var integer
     **/
    public $powiat_id;
    /**
     * gmina_id
     *
     * @var integer
     **/
    public $gmina_id;
    /**
     * miejscowosc_id
     *
     * @var integer
     **/
    public $miejscowosc_id;
    /**
     * kod_pocztowy_id
     *
     * @var integer
     **/
    public $kod_pocztowy_id;
    /**
     * adres_kod_pocztowy
     *
     * @var integer
     **/
    public $adres_kod_pocztowy;
    /**
     * adres_kraj
     *
     * @var string
     **/
    public $adres_kraj;
    /**
     * adres_lokal
     *
     * @var string
     **/
    public $adres_lokal;
    /**
     * adres_miejscowosc
     *
     * @var string
     **/
    public $adres_miejscowosc;
    /**
     * adres_numer
     *
     * @var string
     **/
    public $adres_numer;
    /**
     * adres_poczta
     *
     * @var string
     **/
    public $adres_poczta;
    /**
     * adres_ulica
     *
     * @var string
     **/
    public $adres_ulica;
    /**
     * siedziba
     *
     * @var string
     **/
    public $siedziba;
    /**
     * cel_dzialania
     *
     * @var string
     **/
    public $cel_dzialania;
    /**
     * data_dokonania_wpisu
     *
     * @var string
     **/
    public $data_dokonania_wpisu;
    /**
     * data_ostatni_wpis
     *
     * @var string|null
     **/
    public $data_ostatni_wpis;
    /**
     * data_rejestracji
     *
     * @var string
     **/
    public $data_rejestracji;
    /**
     * data_sprawdzenia
     *
     * @var string
     **/
    public $data_sprawdzenia;
    /**
     * dotacje_ue_beneficjent_id
     *
     * @var integer|null
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
     *
     * @var integer
     **/
    public $forma_prawna_id;
    /**
     * forma_prawna_str
     *
     * @var string
     **/
    public $forma_prawna_str;
    /**
     * forma_prawna_typ_id
     *
     * @var integer
     **/
    public $forma_prawna_typ_id;
    /**
     * forma_prawna_typ_str - pole dodaane jako dodatkowe
     *
     * @var string
     **/
    public $forma_prawna_typ_str;
    /**
     * gpw
     *
     * @var mixed
     **/
    public $gpw;
    /**
     * gpw_spolka_id
     *
     * @var integer|null
     **/
    public $gpw_spolka_id;
    /**
     * knf_ostrzezenie_id
     *
     * @var integer|null
     **/
    public $knf_ostrzezenie_id;
    /**
     * liczba_akcji_wszystkich_emisji
     *
     * @var integer
     **/
    public $liczba_akcji_wszystkich_emisji;
    /**
     * liczba_czlonkow_komitetu_zal
     *
     * @var integer
     **/
    public $liczba_czlonkow_komitetu_zal;
    /**
     * liczba_dzialalnosci
     *
     * @var integer
     **/
    public $liczba_dzialalnosci;
    /**
     * liczba_emisji_akcji
     *
     * @var integer
     **/
    public $liczba_emisji_akcji;
    /**
     * liczba_jedynych_akcjonariuszy
     *
     * @var integer
     **/
    public $liczba_jedynych_akcjonariuszy;
    /**
     * liczba_nadzorcow
     *
     * @var integer
     **/
    public $liczba_nadzorcow;
    /**
     * liczba_oddzialow
     *
     * @var integer
     **/
    public $liczba_oddzialow;
    /**
     * liczba_prokurentow
     *
     * @var integer
     **/
    public $liczba_prokurentow;
    /**
     * liczba_reprezentantow
     *
     * @var integer
     **/
    public $liczba_reprezentantow;
    /**
     * liczba_wspolnikow
     *
     * @var integer
     **/
    public $liczba_wspolnikow;
    /**
     * liczba_zmian
     *
     * @var integer
     **/
    public $liczba_zmian;
    /**
     * liczba_zmian_umow
     *
     * @var integer
     **/
    public $liczba_zmian_umow;
    /**
     * nazwa_organu_nadzoru
     *
     * @var string
     **/
    public $nazwa_organu_nadzoru;
    /**
     * nazwa_organu_reprezentacji
     *
     * @var string
     **/
    public $nazwa_organu_reprezentacji;
    /**
     * nieprzedsiebiorca
     *
     * @var string
     * @todo DO wyjasnienia znaczenie pola
     **/
    public $nieprzedsiebiorca;
    /**
     * numer_wpisu
     *
     * @var string
     **/
    public $numer_wpisu;
    /**
     * opp
     *
     * @var string|null
     **/
    public $opp;
    /**
     * ostatni_wpis_id
     *
     * @var integer|null
     **/
    public $ostatni_wpis_id;
    /**
     * oznaczenie_sadu
     *
     * @var string
     **/
    public $oznaczenie_sadu;
    /**
     * rejestr
     *
     * @var string
     **/
    public $rejestr;
    /**
     * rejestr_stowarzyszen
     *
     * @var string
     **/
    public $rejestr_stowarzyszen;
    /**
     * sposob_reprezentacji
     *
     * @var string
     **/
    public $sposob_reprezentacji;
    /**
     * sygnatura_akt
     *
     * @var string
     **/
    public $sygnatura_akt;
    /**
     * twitter_account_id
     *
     * @var string
     **/
    public $twitter_account_id;
    /**
     * umowa_spolki_cywilnej
     *
     * @var string|null
     **/
    public $umowa_spolki_cywilnej;
    /**
     * wartosc_czesc_kapitalu_wplaconego
     *
     * @var integer
     **/
    public $wartosc_czesc_kapitalu_wplaconego;
    /**
     * wartosc_kapital_docelowy
     *
     * @var integer
     **/
    public $wartosc_kapital_docelowy;
    /**
     * wartosc_kapital_zakladowy
     *
     * @var integer
     **/
    public $wartosc_kapital_zakladowy;
    /**
     * wartosc_nominalna_akcji
     *
     * @var integer
     **/
    public $wartosc_nominalna_akcji;
    /**
     * wartosc_nominalna_podwyzszenia_kapitalu
     *
     * @var integer
     **/
    public $wartosc_nominalna_podwyzszenia_kapitalu;
    /**
     * wczesniejsza_rejestracja_str
     *
     * @var string
     **/
    public $wczesniejsza_rejestracja_str;
    /**
     * www
     *
     * @var string
     **/
    public $www;
    /**
     * wykreslony
     *
     * @var string
     **/
    public $wykreslony;
    /**
     * @var \mrcnpdlk\MojePanstwo\Model\KrsEntity\Pkd[]
     */
    public $dzialalnosci = [];
    /**
     * @var \mrcnpdlk\MojePanstwo\Model\KrsEntity\Share[]
     */
    public $emisje_akcji = [];
    /**
     * @var \mrcnpdlk\MojePanstwo\Model\KrsEntity\Companies[]
     */
    public $firmy = [];
    /**
     * @var \mrcnpdlk\MojePanstwo\Model\KrsEntity\Person
     */
    public $nadzor = [];
    /**
     * @var \mrcnpdlk\MojePanstwo\Model\KrsEntity\Person
     */
    public $prokurenci = [];
    /**
     * @var \mrcnpdlk\MojePanstwo\Model\KrsEntity\Person
     */
    public $reprezentacja = [];
    /**
     * @var \mrcnpdlk\MojePanstwo\Model\KrsEntity\Person
     */
    public $komitetZalozycielski = [];
    /**
     * @var \mrcnpdlk\MojePanstwo\Model\KrsEntity\Partner
     */
    public $wspolnicy = [];
    /**
     * @var \mrcnpdlk\MojePanstwo\Model\KrsEntity\Department
     */
    public $oddzialy = [];

    /**
     * KrsEntity constructor.
     *
     * @param \stdClass|null $oData
     * @param \stdClass|null $oLayers
     *
     * @throws \mrcnpdlk\MojePanstwo\Exception
     */
    public function __construct(\stdClass $oData = null, \stdClass $oLayers = null)
    {
        parent::__construct($oData);
        if ($oData) {
            $this->id                        = $this->convertToId($this->id);
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
            $this->regon                     = $this->regon === '0' ? null : $this->regon;
            $this->data_sprawdzenia          = $this->data_sprawdzenia ? (new \DateTime($this->data_sprawdzenia))->format('Y-m-d H:i:s') : null;
            switch ($this->forma_prawna_typ_id) {
                case 1:
                    $this->forma_prawna_typ_str = 'Organizacje biznesowe';
                    break;
                case 2:
                    $this->forma_prawna_typ_str = 'Organizacje pozarządowe';
                    break;
                case 3:
                    $this->forma_prawna_typ_str = 'Samodzielne publiczne zakłady opieki zdrowotnej';
                    break;
                default:
                    $this->forma_prawna_typ_str = null;
            }
        }
        if ($oLayers) {
            if (isset($oLayers->dzialalnosci)) {
                foreach ((array)$oLayers->dzialalnosci as $i) {
                    $this->dzialalnosci[] = new Pkd($i);
                }
            }
            if (isset($oLayers->emisje_akcji)) {
                foreach ((array)$oLayers->emisje_akcji as $i) {
                    $this->emisje_akcji[] = new Share($i);
                }
            }
            if (isset($oLayers->firmy)) {
                foreach ((array)$oLayers->firmy as $i) {
                    $this->firmy[] = new Companies($i);
                }
            }
            if (isset($oLayers->nadzor)) {
                foreach ((array)$oLayers->nadzor as $i) {
                    $this->nadzor[] = new Person($i);
                }
            }
            if (isset($oLayers->prokurenci)) {
                foreach ((array)$oLayers->prokurenci as $i) {
                    $this->prokurenci[] = new Person($i);
                }
            }
            if (isset($oLayers->reprezentacja)) {
                foreach ((array)$oLayers->reprezentacja as $i) {
                    $this->reprezentacja[] = new Person($i);
                }
            }
            if (isset($oLayers->wspolnicy)) {
                foreach ((array)$oLayers->wspolnicy as $i) {
                    $this->wspolnicy[] = new Partner($i);
                }
            }
            if (isset($oLayers->oddzialy)) {
                foreach ((array)$oLayers->oddzialy as $i) {
                    $this->oddzialy[] = new Department($i);
                }
            }
            if (isset($oLayers->jedynyAkcjonariusz) && !empty($oLayers->jedynyAkcjonariusz)) /**
             * @todo Implement jedynyAkcjonariusz in object KrsEntity - need example, no doc
             */ {
                Api::getInstance()
                   ->getClient()
                   ->getLogger()
                   ->warning(sprintf('jedynyAkcjonariusz not defined'))
                ;
            }
        }
        if (isset($oLayers->komitetZalozycielski)) {
            foreach ((array)$oLayers->komitetZalozycielski as $i) {
                $this->komitetZalozycielski[] = new Person($i);
            }
        }
    }
}
