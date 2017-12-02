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

namespace mrcnpdlk\MojePanstwo\Model\KrsEntity;

use mrcnpdlk\MojePanstwo\Model\ModelAbstract;

class Share extends ModelAbstract
{
    /**
     * Seria
     *
     * @var string
     */
    public $seria;
    /**
     * Ilość akcji
     *
     * @var integer
     */
    public $liczba;
    /**
     * @var string
     */
    public $rodzaj_uprzywilejowania;


    /**
     * Share constructor.
     *
     * @param \stdClass|null $oData
     *
     * @throws \mrcnpdlk\MojePanstwo\Exception
     */
    public function __construct(\stdClass $oData = null)
    {
        parent::__construct($oData);
        if ($oData) {
            $this->liczba = (int)$this->liczba;
        }
    }
}
