<?php

namespace mrcnpdlk\Regon\Enum;


class Report
{
    const REPORT_ACTIVITY_PHYSIC_PERSON = 'PublDaneRaportFizycznaOsoba';
    const REPORT_ACTIVITY_PHYSIC_CEIDG  = 'PublDaneRaportDzialalnoscFizycznejCeidg';
    const REPORT_ACTIVITY_PHYSIC_AGRO   = 'PublDaneRaportDzialalnoscFizycznejRolnicza';
    const REPORT_ACTIVITY_PHYSIC_OTHER  = 'PublDaneRaportDzialalnoscFizycznejPozostala';
    const REPORT_ACTIVITY_PHYSIC_KRUPGN = 'PublDaneRaportDzialalnoscFizycznejWKrupgn';

    const REPORT_ACTIVITY_LOCAL_PHYSIC = 'PublDaneRaportDzialalnosciLokalnejFizycznej';
    const REPORT_ACTIVITY_PHYSIC       = 'PublDaneRaportDzialalnosciFizycznej';
    const REPORT_ACTIVITY_LAW          = 'PublDaneRaportDzialalnosciPrawnej';
    const REPORT_ACTIVITY_LOCAL_LAW    = 'PublDaneRaportDzialalnosciLokalnejPrawnej';

    const REPORT_LOCALS_PHYSIC = 'PublDaneRaportLokalneFizycznej';
    const REPORT_LOCALS_LAW    = 'PublDaneRaportLokalnePrawnej';
    const REPORT_LOCAL_PHYSIC  = 'PublDaneRaportLokalnaFizycznej';
    const REPORT_LOCAL_LAW     = 'PublDaneRaportLokalnaPrawnej';
    const REPORT_PUBLIC_LAW    = 'PublDaneRaportPrawna';
    const REPORT_COMMON_LAW    = 'PublDaneRaportWspolnicyPrawnej';
    const REPORT_UNIT_TYPE     = 'PublDaneRaportTypJednostki';
}
