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

class Person extends ModelAbstract
{
    /**
     * @var integer
     */
    public $osoba_id;
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
     * @var string
     */
    public $funkcja;


    public function __construct(\stdClass $oData = null)
    {
        parent::__construct($oData);
        if ($oData) {
            $this->osoba_id = $this->convertToId($this->osoba_id);
        }
    }
}
