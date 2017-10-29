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

class ConnectionTest extends TestCase
{
    public function testApiConnect()
    {
        $oClient = new Client();
        $res     = $oClient->request('', 'swagger.json');
        $this->assertInstanceOf(\stdClass::class, $res);
    }
}
