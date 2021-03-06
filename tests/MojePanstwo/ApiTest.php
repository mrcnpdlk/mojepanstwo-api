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


namespace mrcnpdlk\MojePanstwo;


use mrcnpdlk\MojePanstwo\Model\Address\Commune;
use mrcnpdlk\MojePanstwo\Model\Address\District;
use mrcnpdlk\MojePanstwo\Model\Address\Nts;
use mrcnpdlk\MojePanstwo\Model\Address\Province;
use mrcnpdlk\MojePanstwo\Model\KrsEntity;
use mrcnpdlk\MojePanstwo\Model\KrsEntityType;
use mrcnpdlk\MojePanstwo\Model\KrsPerson;
use mrcnpdlk\MojePanstwo\Model\SearchResponse;

class ApiTest extends TestCase
{
    /**
     * @var \mrcnpdlk\MojePanstwo\Api
     */
    private $oApi;

    public function setUp()
    {
        parent::setUp();
        $oClient    = new \mrcnpdlk\MojePanstwo\Client();
        $this->oApi = Api::create($oClient);
    }

    public function testGetClient()
    {
        $this->assertInstanceOf(Client::class, $this->oApi->getClient());
    }

    public function testGetCommune()
    {
        $this->assertInstanceOf(Commune::class, $this->oApi->getCommune(1));
    }

    /**
     * @expectedException \mrcnpdlk\MojePanstwo\Exception
     */
    public function testNotFound()
    {
        $res = $this->oApi->getProvince(111111);
    }

    public function testNtsConvert_one()
    {
        $oNts = new Nts('1234567891');
        $this->assertEquals('1', $oNts->region_id);
        $this->assertEquals('23', $oNts->teryt_wojewodztwo_id);
        $this->assertEquals('45', $oNts->podregion_id);
        $this->assertEquals('67', $oNts->teryt_powiat_id);
        $this->assertEquals('89', $oNts->teryt_gmina_id);
        $this->assertEquals('1', $oNts->teryt_gmina_typ_id);
        $this->assertEquals(2367891, $oNts->teryt_terc_id);
    }

    public function testNtsConvert_two()
    {
        $oNts = new Nts('11234567891');
        $this->assertEquals('1', $oNts->region_id);
        $this->assertEquals('23', $oNts->teryt_wojewodztwo_id);
        $this->assertEquals('45', $oNts->podregion_id);
        $this->assertEquals('67', $oNts->teryt_powiat_id);
        $this->assertEquals('89', $oNts->teryt_gmina_id);
        $this->assertEquals('1', $oNts->teryt_gmina_typ_id);
        $this->assertEquals(2367891, $oNts->teryt_terc_id);
    }

    public function testSearchCommune()
    {
        $res = $this->oApi->searchCommune()->limit(1)->get();
        $this->assertInstanceOf(SearchResponse::class, $res);
        $this->assertEquals(1, count($res->items));
        $this->assertInstanceOf(Commune::class, $res->items[0]->data);
    }

    public function testSearchDistrict()
    {
        $res = $this->oApi->searchDistrict()->limit(1)->get();
        $this->assertInstanceOf(SearchResponse::class, $res);
        $this->assertEquals(1, count($res->items));
        $this->assertInstanceOf(District::class, $res->items[0]->data);
    }

    public function testSearchKrsEntity()
    {
        $res = $this->oApi->searchKrsEntity()->limit(1)->get();
        $this->assertInstanceOf(SearchResponse::class, $res);
        $this->assertEquals(1, count($res->items));
        $this->assertInstanceOf(KrsEntity::class, $res->items[0]->data);
    }

    public function testSearchKrsEntityType()
    {
        $res = $this->oApi->searchKrsEntityType()->limit(1)->get();
        $this->assertInstanceOf(SearchResponse::class, $res);
        $this->assertEquals(1, count($res->items));
        $this->assertInstanceOf(KrsEntityType::class, $res->items[0]->data);
    }

    public function testSearchProvince()
    {
        $res = $this->oApi->searchProvince()->limit(1)->get();
        $this->assertInstanceOf(SearchResponse::class, $res);
        $this->assertEquals(1, count($res->items));
        $this->assertInstanceOf(Province::class, $res->items[0]->data);
    }

    public function testSearchKrsPerson()
    {
        $res = $this->oApi->searchKrsPerson()->limit(1)->get();
        $this->assertInstanceOf(SearchResponse::class, $res);
        $this->assertEquals(1, count($res->items));
        $this->assertInstanceOf(KrsPerson::class, $res->items[0]->data);
    }
}
