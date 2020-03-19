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
 *
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
 * @method static TypeEnum F()
 * @method static TypeEnum LF()
 * @method static TypeEnum P()
 * @method static TypeEnum LP()
 */
class TypeEnum extends Enum
{
    public const F  = 'F';
    public const LF = 'LF';
    public const P  = 'P';
    public const LP = 'LP';

}
