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

/**
 * Class Province
 *
 * @package mrcnpdlk\MojePanstwo\Model
 */
class Province extends ModelAbstract
{
    const CONTEXT = 'wojewodztwa';
    /**
     * @var integer
     */
    public $id;
    /**
     * @var string
     */
    public $nazwa;

    /**
     * Province constructor.
     *
     * @param \stdClass|null $oData
     */
    public function __construct(\stdClass $oData = null)
    {
        parent::__construct($oData);
        if ($oData) {
            $this->id = $this->convertToId($this->id);
        }
    }
}
