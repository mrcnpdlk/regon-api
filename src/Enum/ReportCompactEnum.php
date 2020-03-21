<?php
/**
 * REGON-API
 *
 * Copyright (c) 2020 pudelek.org.pl
 *
 * @license MIT License (MIT)
 *
 * For the full copyright and license information, please view source file
 * that is bundled with this package in the file LICENSE
 * @author  Marcin Pudełek <marcin@pudelek.org.pl>
 */

/**
 * Created by Marcin.
 * Date: 19.03.2020
 * Time: 20:54
 */

namespace Mrcnpdlk\Api\Regon\Enum;

use MyCLabs\Enum\Enum;

/**
 * @method static ReportCompactEnum BIR11NowePodmiotyPrawneOrazDzialalnosciOsFizycznych()
 * @method static ReportCompactEnum BIR11AktualizowanePodmiotyPrawneOrazDzialalnosciOsFizycznych()
 * @method static ReportCompactEnum BIR11SkreslonePodmiotyPrawneOrazDzialalnosciOsFizycznych()
 * @method static ReportCompactEnum BIR11NoweJednostkiLokalne()
 * @method static ReportCompactEnum BIR11AktualizowaneJednostkiLokalne()
 * @method static ReportCompactEnum BIR11SkresloneJednostkiLokalne()
 */
class ReportCompactEnum extends Enum
{
    public const BIR11NowePodmiotyPrawneOrazDzialalnosciOsFizycznych          = 'BIR11NowePodmiotyPrawneOrazDzialalnosciOsFizycznych';
    public const BIR11AktualizowanePodmiotyPrawneOrazDzialalnosciOsFizycznych = 'BIR11AktualizowanePodmiotyPrawneOrazDzialalnosciOsFizycznych';
    public const BIR11SkreslonePodmiotyPrawneOrazDzialalnosciOsFizycznych     = 'BIR11SkreslonePodmiotyPrawneOrazDzialalnosciOsFizycznych';
    public const BIR11NoweJednostkiLokalne                                    = 'BIR11NoweJednostkiLokalne';
    public const BIR11AktualizowaneJednostkiLokalne                           = 'BIR11AktualizowaneJednostkiLokalne';
    public const BIR11SkresloneJednostkiLokalne                               = 'BIR11SkresloneJednostkiLokalne';
}
