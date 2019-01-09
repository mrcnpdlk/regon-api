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
 * @author  Marcin Pudełek <marcin@pudelek.org.pl>
 */

namespace mrcnpdlk\Regon\Enum;


class Report
{
    public const REPORT_ACTIVITY_PHYSIC_PERSON = 'PublDaneRaportFizycznaOsoba';
    public const REPORT_ACTIVITY_PHYSIC_CEIDG  = 'PublDaneRaportDzialalnoscFizycznejCeidg';
    public const REPORT_ACTIVITY_PHYSIC_AGRO   = 'PublDaneRaportDzialalnoscFizycznejRolnicza';
    public const REPORT_ACTIVITY_PHYSIC_OTHER  = 'PublDaneRaportDzialalnoscFizycznejPozostala';
    public const REPORT_ACTIVITY_PHYSIC_KRUPGN = 'PublDaneRaportDzialalnoscFizycznejWKrupgn';

    public const REPORT_ACTIVITY_LOCAL_PHYSIC = 'PublDaneRaportDzialalnosciLokalnejFizycznej';
    public const REPORT_ACTIVITY_PHYSIC       = 'PublDaneRaportDzialalnosciFizycznej';
    public const REPORT_ACTIVITY_LAW          = 'PublDaneRaportDzialalnosciPrawnej';
    public const REPORT_ACTIVITY_LOCAL_LAW    = 'PublDaneRaportDzialalnosciLokalnejPrawnej';

    public const REPORT_LOCALS_PHYSIC = 'PublDaneRaportLokalneFizycznej';
    public const REPORT_LOCALS_LAW    = 'PublDaneRaportLokalnePrawnej';
    public const REPORT_LOCAL_PHYSIC  = 'PublDaneRaportLokalnaFizycznej';
    public const REPORT_LOCAL_LAW     = 'PublDaneRaportLokalnaPrawnej';
    public const REPORT_PUBLIC_LAW    = 'PublDaneRaportPrawna';
    public const REPORT_COMMON_LAW    = 'PublDaneRaportWspolnicyPrawnej';
    public const REPORT_UNIT_TYPE     = 'PublDaneRaportTypJednostki';
}
