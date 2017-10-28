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
 * Time: 19:08
 */
declare (strict_types=1);

namespace mrcnpdlk\MojePanstwo;


use mrcnpdlk\MojePanstwo\Model\KrsEntity;

class Api
{
    /**
     * @var \mrcnpdlk\MojePanstwo\Api
     */
    protected static $instance = null;

    /**
     * @var \mrcnpdlk\MojePanstwo\Client
     */
    private $oClient;

    /**
     * Api constructor.
     *
     * @param \mrcnpdlk\MojePanstwo\Client $oClient
     */
    protected function __construct(Client $oClient)
    {
        $this->oClient = $oClient;
    }

    /**
     * @param \mrcnpdlk\MojePanstwo\Client $oClient
     *
     * @return \mrcnpdlk\MojePanstwo\Api
     */
    public static function create(Client $oClient)
    {
        if (!isset(static::$instance)) {
            static::$instance = new static($oClient);
        }

        return static::$instance;
    }

    /**
     * @return \mrcnpdlk\MojePanstwo\Api
     * @throws \mrcnpdlk\MojePanstwo\Exception
     */
    public static function getInstance()
    {
        if (!isset(static::$instance)) {
            throw new Exception(sprintf('First call CREATE method!'));
        }

        return static::$instance;
    }

    /**
     * @param string $krs
     *
     * @return \mrcnpdlk\MojePanstwo\Model\KrsEntity
     */
    public function getKrsEntity(string $krs)
    {
        $krs = ltrim($krs, '0');
        $res = $this->oClient->request('krs_podmioty', intval($krs));

        return new KrsEntity($res->data);
    }

}
