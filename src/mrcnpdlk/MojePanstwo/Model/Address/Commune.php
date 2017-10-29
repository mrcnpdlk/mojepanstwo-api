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

namespace mrcnpdlk\MojePanstwo\Model\Address;

use mrcnpdlk\MojePanstwo\Model\ModelAbstract;

/**
 * Class Commune
 *
 * @package mrcnpdlk\MojePanstwo\Model
 */
class Commune extends ModelAbstract
{
    const CONTEXT = 'gminy';

    /**
     * @var int
     */
    public $wojewodztwo_id;
    /**
     * @var string
     */
    public $wojewodztwo_nazwa;
    /**
     * @var integer
     */
    public $powiat_id;
    /**
     * @var string
     */
    public $powiat_nazwa;
    /**
     * @var int
     */
    public $id;
    /**
     * @var string
     */
    public $nts;
    /**
     * @var \mrcnpdlk\MojePanstwo\Model\Address\Nts
     */
    public $nts_teryt;
    /**
     * @var string
     */
    public $teryt;
    /**
     * @var string
     */
    public $nazwa;
    /**
     * @var string
     */
    public $nazwa_urzedu;
    /**
     * @var integer
     */
    public $typ_id;
    /**
     * @var string
     */
    public $typ_nazwa;
    /**
     * @var string
     */
    public $rada_nazwa;
    /**
     * @var integer
     */
    public $szef_stanowisko_id;
    /**
     * @var string
     */
    public $adres;
    /**
     * @var string
     */
    public $bip_www;
    /**
     * @var string
     */
    public $email;
    /**
     * @var string
     */
    public $telefon;
    /**
     * @var string
     */
    public $fax;
    /**
     * @var float
     */
    public $wydatki_roczne;
    /**
     * @var float
     */
    public $zadluzenie_roczne;
    /**
     * @var float
     */
    public $dochody_roczne;
    /**
     * @var int
     */
    public $liczba_ludnosci;
    /**
     * @var float
     */
    public $powierzchnia;
    /**
     * @var string
     */
    public $powiatowa;
    /**
     * @var string
     */
    public $wojewodzka;


    /**
     * Commune constructor.
     *
     * @param \stdClass|null $oData
     */
    public function __construct(\stdClass $oData = null)
    {
        /**
         * Hack for values with different namespace
         */
        $this->{'wojewodztwa.id'}        = null;
        $this->{'wojewodztwa.nazwa'}     = null;
        $this->{'powiaty.id'}            = null;
        $this->{'powiaty.typ_id'}        = null;
        $this->{'powiaty.nazwa'}         = null;
        $this->{'powiaty.sejm_okreg_id'} = null;

        parent::__construct($oData);
        if ($oData) {
            $this->id                 = $this->convertToId($this->id);
            $this->typ_id             = $this->convertToId($this->typ_id);
            $this->wojewodztwo_id     = $this->convertToId($this->wojewodztwo_id);
            $this->powiat_id          = $this->convertToId($this->powiat_id);
            $this->szef_stanowisko_id = $this->convertToId($this->szef_stanowisko_id);
            $this->telefon            = $this->cleanTelephoneNr($this->telefon);
            $this->fax                = $this->cleanTelephoneNr($this->fax);

            $this->wojewodztwo_nazwa = $this->{'wojewodztwa.nazwa'};
            $this->powiat_nazwa      = $this->{'powiaty.nazwa'};
            $this->powierzchnia      = floatval($this->powierzchnia);
            $this->zadluzenie_roczne = floatval($this->zadluzenie_roczne);
            $this->dochody_roczne    = floatval($this->dochody_roczne);
            $this->nts_teryt         = new Nts($this->nts);
        }
    }
}
