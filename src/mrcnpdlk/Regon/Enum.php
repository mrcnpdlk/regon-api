<?php
/**
 * Created by Marcin Pudełek <marcin@pudelek.org.pl>
 * Date: 11.09.2017
 * Time: 17:09
 */

namespace mrcnpdlk\Regon;


class Enum
{
    const BASE_WSDL_XSD_TEST = 'https://wyszukiwarkaregontest.stat.gov.pl/wsBIR/wsdl/UslugaBIRzewnPubl.xsd';
    const BASE_WSDL_SVC_TEST = 'https://Wyszukiwarkaregontest.stat.gov.pl/wsBIR/UslugaBIRzewnPubl.svc';
    const BASE_WSDL_XSD      = 'https://wyszukiwarkaregontest.stat.gov.pl/wsBIR/wsdl/UslugaBIRzewnPubl.xsd'; //taki sam jak do testowego
    const BASE_WSDL_SVC      = 'https://wyszukiwarkaregon.stat.gov.pl/wsBIR/UslugaBIRzewnPubl.svc';
    const BASE_WSDL_TEST_KEY = 'abcde12345abcde12345';
}