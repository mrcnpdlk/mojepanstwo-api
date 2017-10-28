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
 * @author Marcin Pudełek <marcin@pudelek.org.pl>
 */

declare (strict_types=1);

namespace mrcnpdlk\MojePanstwo\Model\KrsEntity;

use mrcnpdlk\MojePanstwo\Model\ModelAbstract;


class Partner extends ModelAbstract
{
    /**
     * @var string
     */
    public $nazwa;
    /**
     * @var string
     */
    public $data_urodzenia;
    /**
     * @var string
     */
    public $privacy_level;
    /**
     * @var integer
     */
    public $osoba_id;
    /**
     * @var integer
     */
    public $krs_id;
    /**
     * @var integer
     */
    public $id;
    /**
     * @var string
     */
    public $funkcja;
    /**
     * @var integer
     */
    public $udzialy_liczba;
    /**
     * @var float
     */
    public $udzialy_wartosc_jedn;
    /**
     * @var float
     */
    public $udzialy_wartosc;


    public function __construct(\stdClass $oData = null)
    {
        parent::__construct($oData);
        if ($oData) {
            $this->osoba_id              = $this->convertToId($this->osoba_id);
            $this->krs_id                = $this->convertToId($this->krs_id);
            $this->id                    = $this->convertToId($this->id);
            $this->udzialy_wartosc_jedn = is_null($this->udzialy_wartosc_jedn) ? null : floatval($this->udzialy_wartosc_jedn);
            $this->udzialy_wartosc       = is_null($this->udzialy_wartosc) ? null : floatval($this->udzialy_wartosc);
        }
    }
}
