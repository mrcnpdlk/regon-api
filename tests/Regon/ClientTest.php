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


use mrcnpdlk\Teryt\ResponseModel\Territory\JednostkaTerytorialna;
use Psr\Log\NullLogger;

class ClientTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testEmptyLogger()
    {
        $oClient    = new \mrcnpdlk\Regon\Client();
        $this->assertInstanceOf(NullLogger::class, $oClient->getLogger());
    }

    public function testEmptyCache()
    {
        $oClient    = new \mrcnpdlk\Regon\Client();
        $this->assertEquals(null, $oClient->getCache());
    }

}
