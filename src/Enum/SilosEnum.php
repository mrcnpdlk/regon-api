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
 * @method static SilosEnum CEIDG()
 * @method static SilosEnum AGRICULT()
 * @method static SilosEnum OTHER()
 * @method static SilosEnum KRUPGN()
 * @method static SilosEnum LAW()
 */
class SilosEnum extends Enum
{
    public const CEIDG    = 1;
    public const AGRICULT = 2;
    public const OTHER    = 3;
    public const KRUPGN   = 4;
    public const LAW      = 6;
}
