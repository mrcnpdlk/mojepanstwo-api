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

class Pkd extends ModelAbstract
{
    /**
     * @var integer
     */
    public $id;
    /**
     * Opis
     *
     * @var string
     */
    public $str;
    /**
     * @var boolean
     */
    public $przewazajaca;


    /**
     * Pkd constructor.
     *
     * @param \stdClass|null $oData
     *
     * @throws \mrcnpdlk\MojePanstwo\Exception
     */
    public function __construct(\stdClass $oData = null)
    {
        parent::__construct($oData);
        if ($oData) {
            $this->id = $this->convertToId($this->id);
        }
    }
}
