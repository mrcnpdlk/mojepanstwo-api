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


use mrcnpdlk\MojePanstwo\Model\Address\Commune;
use mrcnpdlk\MojePanstwo\Model\Address\District;
use mrcnpdlk\MojePanstwo\Model\Address\Province;
use mrcnpdlk\MojePanstwo\Model\KrsEntity;
use mrcnpdlk\MojePanstwo\Model\KrsEntityType;
use mrcnpdlk\MojePanstwo\Model\KrsPerson;

class Api
{
    /**
     * @var \mrcnpdlk\MojePanstwo\Api
     */
    protected static $instance;

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
    public static function create(Client $oClient): Api
    {
        if (null === static::$instance) {
            static::$instance = new static($oClient);
        }

        return static::$instance;
    }

    /**
     * @return \mrcnpdlk\MojePanstwo\Api
     * @throws \mrcnpdlk\MojePanstwo\Exception
     */
    public static function getInstance(): Api
    {
        if (null === static::$instance) {
            throw new Exception(sprintf('First call CREATE method!'));
        }

        return static::$instance;
    }

    /**
     * @return \mrcnpdlk\MojePanstwo\Client
     */
    public function getClient(): Client
    {
        return $this->oClient;
    }

    /**
     * @param $id
     *
     * @return Commune
     * @throws \mrcnpdlk\MojePanstwo\Exception
     */
    public function getCommune($id): Commune
    {
        $qb = QueryBuilder::create(Commune::class);

        return $qb->find((string)$id);
    }

    /**
     * @param $id
     *
     * @return District
     * @throws \mrcnpdlk\MojePanstwo\Exception
     */
    public function getDistrict($id): District
    {
        $qb = QueryBuilder::create(District::class);

        return $qb->find((string)$id);
    }

    /**
     * Return KRS Entity by ID (krs)
     *
     * @param string|int $krs      ID or KRS number
     *
     * @param int        $pullFlag Additional layers. E.i: KrsEntity::PULL_PKDS | KrsEntity::PULL_PERSON_REPRESENTATION
     *
     * @return \mrcnpdlk\MojePanstwo\Model\KrsEntity
     * @throws \mrcnpdlk\MojePanstwo\Exception
     */
    public function getKrsEntity($krs, int $pullFlag = KrsEntity::PULL_NONE): KrsEntity
    {
        $krs = (int)$krs;
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

        return $qb->find((string)$krs);
    }

    /**
     * Return KRS Entity Type
     *
     * @param $id
     *
     * @return \mrcnpdlk\MojePanstwo\Model\KrsEntityType
     * @throws \mrcnpdlk\MojePanstwo\Exception
     */
    public function getKrsEntityType($id): KrsEntityType
    {
        $qb = QueryBuilder::create(KrsEntityType::class);

        return $qb->find((string)$id);
    }

    /**
     * @param     $id
     *
     * @param int $pullFlag
     *
     * @return KrsPerson
     * @throws \mrcnpdlk\MojePanstwo\Exception
     */
    public function getKrsPerson($id, int $pullFlag = KrsPerson::PULL_NONE): KrsPerson
    {
        $qb = QueryBuilder::create(KrsPerson::class);

        /**
         * @var KrsPerson $oKrsPerson
         */
        $oKrsPerson = $qb->find((string)$id);

        if ($pullFlag & KrsPerson::PULL_KRS_ENTITIES) {
            foreach ($oKrsPerson->podmioty as $item) {
                $item->podmiot = $this->getKrsEntity($item->podmiot_id);
            }
        }


        return $oKrsPerson;
    }

    /**
     * Return Province
     *
     * @param $id
     *
     * @return Province
     * @throws \mrcnpdlk\MojePanstwo\Exception
     */
    public function getProvince($id): Province
    {
        $qb = QueryBuilder::create(Province::class);

        return $qb->find((string)$id);
    }

    /**
     * @return \mrcnpdlk\MojePanstwo\QueryBuilder
     * @throws \mrcnpdlk\MojePanstwo\Exception
     */
    public function searchCommune(): QueryBuilder
    {
        return QueryBuilder::create(Commune::class);
    }

    /**
     * @return \mrcnpdlk\MojePanstwo\QueryBuilder
     * @throws \mrcnpdlk\MojePanstwo\Exception
     */
    public function searchDistrict(): QueryBuilder
    {
        return QueryBuilder::create(District::class);
    }

    /**
     * Return QueryBuilder for searching KRS Entities
     *
     * @return \mrcnpdlk\MojePanstwo\QueryBuilder
     * @throws \mrcnpdlk\MojePanstwo\Exception
     */
    public function searchKrsEntity(): QueryBuilder
    {
        return QueryBuilder::create(KrsEntity::class);
    }

    /**
     * Return QueryBuilder for searching KRS Entity Types
     *
     * @return \mrcnpdlk\MojePanstwo\QueryBuilder
     * @throws \mrcnpdlk\MojePanstwo\Exception
     */
    public function searchKrsEntityType(): QueryBuilder
    {
        return QueryBuilder::create(KrsEntityType::class);
    }

    /**
     * Wyszukiwanie osoby w KRS
     *
     * @return \mrcnpdlk\MojePanstwo\QueryBuilder
     * @throws \mrcnpdlk\MojePanstwo\Exception
     */
    public function searchKrsPerson(): QueryBuilder
    {
        return QueryBuilder::create(KrsPerson::class);
    }

    /**
     * @return \mrcnpdlk\MojePanstwo\QueryBuilder
     * @throws \mrcnpdlk\MojePanstwo\Exception
     */
    public function searchProvince(): QueryBuilder
    {
        return QueryBuilder::create(Province::class);
    }

}
