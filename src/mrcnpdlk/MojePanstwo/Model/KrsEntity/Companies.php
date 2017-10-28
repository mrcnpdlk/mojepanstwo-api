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

class Companies extends ModelAbstract
{
    /**
     * @var int
     */
    public $id;
    /**
     * @var string
     */
    public $nazwa;
    /**
     * @var string
     */
    public $udzialy_str;
    /**
     * @var string
     */
    public $udzialy_status;
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
            $this->udzialy_wartosc_jedn = floatval($this->udzialy_wartosc_jedn);
            $this->udzialy_wartosc      = floatval($this->udzialy_wartosc);
        }
    }
}
