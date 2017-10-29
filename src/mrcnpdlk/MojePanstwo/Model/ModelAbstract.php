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
 * Time: 20:58
 */
declare (strict_types=1);

namespace mrcnpdlk\MojePanstwo\Model;

use mrcnpdlk\MojePanstwo\Api;

/**
 * Class ModelAbstract
 *
 * @package mrcnpdlk\MojePanstwo\Model
 */
class ModelAbstract extends \stdClass
{
    const CONTEXT = '';

    /**
     * ModelAbstract constructor.
     *
     * @param \stdClass|null $oData
     * @param \stdClass|null $oLayers
     */
    public function __construct(\stdClass $oData = null, \stdClass $oLayers = null)
    {
        if (!is_null($oData)) {
            foreach ($oData as $key => $value) {
                $key = $this->stripProperty($key);
                if (!property_exists($this, $key)) {
                    Api::getInstance()
                       ->getClient()
                       ->getLogger()
                       ->warning(sprintf('Property [%s] not exists in object [%s]', $key, get_class($this)))
                    ;
                } elseif (!is_array($value) && !is_object($value)) {
                    $this->{$key} = is_string($value) && $value === '' ? null : $value;
                }
            }
        }
    }

    /**
     * Cleaning telephone number
     *
     * @param $nr
     *
     * @return string|null
     */
    protected function cleanTelephoneNr($nr)
    {
        if (!empty($value)) {
            $nr = preg_replace('/[^0-9]/', '', strval($nr));

            //removing zeros only for national numbers (only single zero at the beginning)
            return preg_replace('/^0(?=([1-9]+[0-9]*))/', '', $nr);
        }

        return null;
    }

    /**
     * Convert string to integer
     *
     * @param string $value
     *
     * @return int|null
     */
    protected function convertToId($value)
    {
        return empty($value) ? null : intval($value);
    }

    /**
     * Remove namesoace class from the property name
     *
     * @param string $property
     *
     * @return string
     */
    protected function stripProperty(string $property)
    {
        return str_replace(static::CONTEXT . '.', '', $property);
    }

}
