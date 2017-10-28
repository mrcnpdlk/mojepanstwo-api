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
     * @return \mrcnpdlk\MojePanstwo\Client
     */
    public function getClient()
    {
        return $this->oClient;
    }

    /**
     * @param string|int $krs
     *
     * @return \mrcnpdlk\MojePanstwo\Model\KrsEntity
     */
    public function getKrsEntity($krs)
    {
        $krs = intval($krs);

        $qb  = QueryBuilder::create()
                           ->setContext(KrsEntity::CONTEXT)
                           ->addLayer('dzialalnosci')//
                           ->addLayer('emisje_akcji')//
                           ->addLayer('firmy')//
                           ->addLayer('jedynyAkcjonariusz')
                           ->addLayer('komitetZalozycielski')
                           ->addLayer('nadzor')//
                           ->addLayer('oddzialy')
                           ->addLayer('prokurenci')//
                           ->addLayer('reprezentacja')//
                           ->addLayer('wspolnicy') //
        ;
        $res = $this->oClient->request(KrsEntity::CONTEXT, intval($krs), $qb);
        var_dump($res->layers);

        return new KrsEntity($res->data ?? null, $res->layers ?? null);
    }

}
