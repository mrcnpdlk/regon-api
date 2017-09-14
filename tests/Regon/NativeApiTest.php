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


class NativeApiTest extends TestCase
{
    /**
     * @var NativeApi
     */
    private $oNativeApi;

    public function setUp()
    {
        $oClient          = new \mrcnpdlk\Regon\Client();
        $this->oNativeApi = NativeApi::create($oClient);
    }

    public function testStanDanych()
    {
        $this->assertEquals(false, empty($this->oNativeApi->GetValue('StanDanych')));
    }

    public function testStatusUslugi()
    {
        $this->assertArrayHasKey($this->oNativeApi->GetValue('StatusUslugi'), ['1', '2']);
    }

    /**
     * @expectedException \mrcnpdlk\Regon\Exception\NotFound
     */
    public function testDaneSzukajNotFound()
    {
        $this->oNativeApi->DaneSzukaj('invalid_regon');
    }

    public function testDaneSzukajFound()
    {
        $res = $this->oNativeApi->DaneSzukaj('000331501'); // GUS Regon
        $this->assertEquals(true, is_array($res));
        $this->assertInstanceOf(\stdClass::class, $res[0]);
    }

}
