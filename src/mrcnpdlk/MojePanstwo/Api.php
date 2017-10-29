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
     * @param string|int $krs ID or KRS number
     *
     * @param int        $pullFlag
     *
     * @return \mrcnpdlk\MojePanstwo\Model\KrsEntity
     */
    public function getKrsEntity($krs, int $pullFlag = KrsEntity::PULL_NONE)
    {
        $krs = intval($krs);
        $qb  = QueryBuilder::create(KrsEntity::class)
                           ->addLayer('jedynyAkcjonariusz')
                           ->addLayer('komitetZalozycielski')
        ;
        if ($pullFlag & KrsEntity::PULL_COMPANIES) {
            $qb->addLayer('firmy');
        }
        if ($pullFlag & KrsEntity::PULL_DEPARTMENTS) {
            $qb->addLayer('oddzialy');
        }
        if ($pullFlag & KrsEntity::PULL_PARTNERS) {
            $qb->addLayer('wspolnicy');
        }
        if ($pullFlag & KrsEntity::PULL_PKDS) {
            $qb->addLayer('dzialalnosci');
        }
        if ($pullFlag & KrsEntity::PULL_SHARES) {
            $qb->addLayer('emisje_akcji');
        }
        if ($pullFlag & KrsEntity::PULL_PERSON_REPRESENTATION) {
            $qb->addLayer('reprezentacja');
        }
        if ($pullFlag & KrsEntity::PULL_PERSON_SUPERVISION) {
            $qb->addLayer('nadzor');
        }
        if ($pullFlag & KrsEntity::PULL_PERSON_PROXY) {
            $qb->addLayer('prokurenci');
        }

        return $qb->find(strval($krs));
    }

    public function searchKrsEntity()
    {
        return QueryBuilder::create(KrsEntity::class);
    }

}
