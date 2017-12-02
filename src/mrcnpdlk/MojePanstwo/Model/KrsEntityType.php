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

/**
 * Created by Marcin.
 * Date: 28.10.2017
 * Time: 19:59
 */
declare (strict_types=1);

namespace mrcnpdlk\MojePanstwo\Model;


/**
 * Class KrsEntityType
 *
 * @package mrcnpdlk\MojePanstwo\Model
 */
class KrsEntityType extends ModelAbstract
{
    const CONTEXT = 'krs_formy_prawne';

    /**
     * ID
     *
     * @var integer
     **/
    public $id;
    /**
     * Nazwa
     *
     * @var string
     **/
    public $nazwa;
    /**
     * krs
     *
     * @var string
     **/
    public $typ_id;
    /**
     * @var string
     */
    public $typ_nazwa;

    /**
     * KrsEntityType constructor.
     *
     * @param \stdClass|null $oData
     *
     * @throws \mrcnpdlk\MojePanstwo\Exception
     */
    public function __construct(\stdClass $oData = null)
    {
        parent::__construct($oData);
        if ($oData) {
            $this->id     = $this->convertToId($this->id);
            $this->typ_id = $this->convertToId($this->typ_id);
            switch ($this->typ_id) {
                case 1:
                    $this->typ_nazwa = 'Organizacje biznesowe';
                    break;
                case 2:
                    $this->typ_nazwa = 'Organizacje pozarządowe';
                    break;
                case 3:
                    $this->typ_nazwa = 'Samodzielne publiczne zakłady opieki zdrowotnej';
                    break;
                default:
                    $this->typ_nazwa = null;
            }
        }
    }
}
