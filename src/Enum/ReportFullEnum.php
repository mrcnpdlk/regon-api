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

namespace mrcnpdlk\Regon\Enum;


use MyCLabs\Enum\Enum;

/**
 * @method static ReportFullEnum BIR11OsFizycznaDaneOgolne()
 * @method static ReportFullEnum BIR11OsFizycznaDzialalnoscCeidg()
 * @method static ReportFullEnum BIR11OsFizycznaDzialalnoscRolnicza()
 * @method static ReportFullEnum BIR11OsFizycznaDzialalnoscPozostala()
 * @method static ReportFullEnum BIR11OsFizycznaDzialalnoscSkreslona()
 * @method static ReportFullEnum BIR11OsFizycznaPkd()
 * @method static ReportFullEnum BIR11OsFizycznaListaJednLokalnych()
 * @method static ReportFullEnum BIR11JednLokalnaOsFizycznej()
 * @method static ReportFullEnum BIR11JednLokalnaOsFizycznejPkd()
 * @method static ReportFullEnum BIR11OsPrawna()
 * @method static ReportFullEnum BIR11OsPrawnaPkd()
 * @method static ReportFullEnum BIR11OsPrawnaListaJednLokalnych()
 * @method static ReportFullEnum BIR11JednLokalnaOsPrawnej()
 * @method static ReportFullEnum BIR11JednLokalnaOsPrawnejPkd()
 * @method static ReportFullEnum BIR11OsPrawnaSpCywilnaWspolnicy()
 * @method static ReportFullEnum BIR11TypPodmiotu()
 */
class ReportFullEnum extends Enum
{
    public const BIR11OsFizycznaDaneOgolne           = 'BIR11OsFizycznaDaneOgolne';
    public const BIR11OsFizycznaDzialalnoscCeidg     = 'BIR11OsFizycznaDzialalnoscCeidg';
    public const BIR11OsFizycznaDzialalnoscRolnicza  = 'BIR11OsFizycznaDzialalnoscRolnicza';
    public const BIR11OsFizycznaDzialalnoscPozostala = 'BIR11OsFizycznaDzialalnoscPozostala';
    public const BIR11OsFizycznaDzialalnoscSkreslona = 'BIR11OsFizycznaDzialalnoscSkreslona';
    public const BIR11OsFizycznaPkd                  = 'BIR11OsFizycznaPkd';
    public const BIR11OsFizycznaListaJednLokalnych   = 'BIR11OsFizycznaListaJednLokalnych';
    public const BIR11JednLokalnaOsFizycznej         = 'BIR11JednLokalnaOsFizycznej';
    public const BIR11JednLokalnaOsFizycznejPkd      = 'BIR11JednLokalnaOsFizycznejPkd';
    public const BIR11OsPrawna                       = 'BIR11OsPrawna';
    public const BIR11OsPrawnaPkd                    = 'BIR11OsPrawnaPkd';
    public const BIR11OsPrawnaListaJednLokalnych     = 'BIR11OsPrawnaListaJednLokalnych';
    public const BIR11JednLokalnaOsPrawnej           = 'BIR11JednLokalnaOsPrawnej';
    public const BIR11JednLokalnaOsPrawnejPkd        = 'BIR11JednLokalnaOsPrawnejPkd';
    public const BIR11OsPrawnaSpCywilnaWspolnicy     = 'BIR11OsPrawnaSpCywilnaWspolnicy';
    public const BIR11TypPodmiotu                    = 'BIR11TypPodmiotu';

}
