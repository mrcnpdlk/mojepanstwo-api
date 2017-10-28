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

class ModelAbstract
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
     * @param string $value
     *
     * @return int|null
     */
    protected function convertToId($value)
    {
        return empty($value) ? null : intval($value);
    }

    /**
     * @param string $property
     *
     * @return string
     */
    protected function stripProperty(string $property)
    {
        return str_replace(static::CONTEXT . '.', '', $property);
    }

}
