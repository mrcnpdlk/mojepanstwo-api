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
 * Class District
 *
 * @package mrcnpdlk\MojePanstwo\Model
 */
class District extends ModelAbstract
{
    const CONTEXT = 'powiaty';
    /**
     * @var integer
     */
    public $id;
    /**
     * @var integer
     */
    public $typ_id;
    /**
     * @var integer
     */
    public $wojewodztwo_id;
    /**
     * @var string
     */
    public $wojewodztwo_nazwa;
    /**
     * @var string
     */
    public $nts;
    /**
     * NTS data
     *
     * @var \mrcnpdlk\MojePanstwo\Model\Address\Nts
     */
    public $nts_object;
    /**
     * @var string
     */
    public $nazwa;
    /**
     * @var integer
     */
    public $senat_okreg_id;
    /**
     * @var integer
     */
    public $sejm_okreg_id;

    /**
     * District constructor.
     *
     * @param \stdClass|null $oData
     */
    public function __construct(\stdClass $oData = null)
    {
        /**
         * Hack for values with different namespace
         */
        $this->{'wojewodztwa.id'}    = null;
        $this->{'wojewodztwa.nazwa'} = null;

        parent::__construct($oData);
        if ($oData) {
            $this->id                = $this->convertToId($this->id);
            $this->typ_id            = $this->convertToId($this->typ_id);
            $this->wojewodztwo_id    = $this->convertToId($this->wojewodztwo_id);
            $this->senat_okreg_id    = $this->convertToId($this->senat_okreg_id);
            $this->sejm_okreg_id     = $this->convertToId($this->sejm_okreg_id);
            $this->wojewodztwo_nazwa = $this->{'wojewodztwa.nazwa'};
            $this->nts_object        = new Nts($this->nts);
        }
    }
}
