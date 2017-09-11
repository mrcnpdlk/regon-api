<?php

namespace mrcnpdlk\Regon\Enum;


class Report
{
    const REPORT_ACTIVITY_PHYSIC_PERSON           = 'PublDaneRaportFizycznaOsoba';
    const REPORT_ACTIVITY_PHYSIC_CEIDG            = 'PublDaneRaportDzialalnoscFizycznejCeidg';
    const REPORT_ACTIVITY_PHYSIC_AGRO             = 'PublDaneRaportDzialalnoscFizycznejRolnicza';
    const REPORT_ACTIVITY_PHYSIC_OTHER_PUBLIC     = 'PublDaneRaportDzialalnoscFizycznejPozostala';
    const REPORT_ACTIVITY_PHYSIC_PUBLIC           = 'PublDaneRaportDzialalnosciFizycznej';
    const REPORT_ACTIVITY_LAW_PUBLIC              = 'PublDaneRaportDzialalnosciPrawnej';
    const REPORT_ACTIVITY_LOCAL_LAW_PUBLIC        = 'PublDaneRaportDzialalnosciLokalnejPrawnej';
    const REPORT_ACTIVITY_LOCAL_PHYSIC_PUBLIC     = 'PublDaneRaportDzialalnosciLokalnejFizycznej';
    const REPORT_ACTIVITY_LOCAL_PHYSIC_WKR_PUBLIC = 'PublDaneRaportDzialalnoscFizycznejWKrupgn';
    const REPORT_LOCALS_PHYSIC_PUBLIC             = 'PublDaneRaportLokalneFizycznej';
    const REPORT_LOCALS_LAW_PUBLIC                = 'PublDaneRaportLokalnePrawnej';
    const REPORT_LOCAL_PHYSIC_PUBLIC              = 'PublDaneRaportLokalnaFizycznej';
    const REPORT_LOCAL_LAW_PUBLIC                 = 'PublDaneRaportLokalnaPrawnej';
    const REPORT_PUBLIC_LAW                       = 'PublDaneRaportPrawna';
    const REPORT_COMMON_LAW_PUBLIC                = 'PublDaneRaportWspolnicyPrawnej';
    const REPORT_UNIT_TYPE_PUBLIC                 = 'PublDaneRaportTypJednostki';
}
