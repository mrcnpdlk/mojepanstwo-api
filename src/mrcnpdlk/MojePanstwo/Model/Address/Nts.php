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


use mrcnpdlk\MojePanstwo\Api;

class Nts
{
    /**
     * @var string
     */
    public $region_id;
    /**
     * @var string
     */
    public $podregion_id;
    /**
     * @var string
     */
    public $teryt_wojewodztwo_id;
    /**
     * @var string
     */
    public $teryt_powiat_id;
    /**
     * @var string
     */
    public $teryt_gmina_id;
    /**
     * @var string
     */
    public $teryt_gmina_typ_id;
    /**
     * @var int
     */
    public $teryt_terc_id;

    /**
     * Nts constructor.
     *
     * @param string|null $nts
     *
     * @throws \mrcnpdlk\MojePanstwo\Exception
     */
    public function __construct(string $nts = null)
    {
        if (null === $nts || \strlen($nts) < 10) {
            Api::getInstance()
               ->getClient()
               ->getLogger()
               ->warning(sprintf('Invalid value of NTS code [%s]', $nts))
            ;
        } else {
            /** @noinspection SubStrUsedAsArrayAccessInspection */
            $this->teryt_gmina_typ_id   = substr($nts, -1, 1);
            $this->teryt_gmina_id       = substr($nts, -3, 2);
            $this->teryt_powiat_id      = substr($nts, -5, 2);
            $this->podregion_id         = substr($nts, -7, 2);
            $this->teryt_wojewodztwo_id = substr($nts, -9, 2);
            /** @noinspection SubStrUsedAsArrayAccessInspection */
            $this->region_id = substr($nts, -10, 1);
            if ($this->teryt_powiat_id === '00') {
                $this->teryt_powiat_id = null;
            }
            if ($this->teryt_gmina_id === '00') {
                $this->teryt_gmina_id = null;
            }
            if ($this->teryt_gmina_typ_id === '0') {
                $this->teryt_gmina_typ_id = null;
            }
            if ($this->teryt_powiat_id && $this->teryt_gmina_id) {
                $this->teryt_terc_id = (int)($this->teryt_wojewodztwo_id . $this->teryt_powiat_id . $this->teryt_gmina_id . $this->teryt_gmina_typ_id);
            }

        }

    }
}
