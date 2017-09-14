<?php
/**
 * REGON-API
 *
 * Copyright (c) 2017 pudelek.org.pl
 *
 * @license MIT License (MIT)
 *
 * For the full copyright and license information, please view source file
 * that is bundled with this package in the file LICENSE
 *
 * @author Marcin Pudełek <marcin@pudelek.org.pl>
 */

namespace mrcnpdlk\Regon;

class ConnectionTest extends TestCase
{
    public function testConnect()
    {
        $oClient    = new \mrcnpdlk\Regon\Client();
        $oClient->login();
        $this->assertEquals(true, $oClient->isLogged());
    }

    public function testEmptySession()
    {
        $oClient    = new \mrcnpdlk\Regon\Client();
        $oClient->login();
        $oClient->logout();
        $this->assertEquals(false, $oClient->isLogged());
    }

    /**
     * @expectedException \mrcnpdlk\Regon\Exception
     */
    public function testInvalidAuth()
    {
        $oClient    = new \mrcnpdlk\Regon\Client();
        $oClient->setConfig('some_invalid_key');
        $oClient->login();
    }
}
