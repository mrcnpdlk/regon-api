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
 * @method static ValueEnum StanDanych()
 * @method static ValueEnum KomunikatKod()
 * @method static ValueEnum KomunikatTresc()
 * @method static ValueEnum StatusSesji()
 * @method static ValueEnum StatusUslugi()
 * @method static ValueEnum KomunikatUslugi()
 */
class ValueEnum extends Enum
{
    public const StanDanych      = 'StanDanych';
    public const KomunikatKod    = 'KomunikatKod';
    public const KomunikatTresc  = 'KomunikatTresc';
    public const StatusSesji     = 'StatusSesji';
    public const StatusUslugi    = 'StatusUslugi';
    public const KomunikatUslugi = 'KomunikatUslugi';
}
