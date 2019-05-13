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

/**
 * Created by Marcin Pudełek <marcin@pudelek.org.pl>
 * Date: 11.09.2017
 * Time: 17:09
 */

namespace mrcnpdlk\Regon\Enum;


class Connection
{
    public const BASE_WSDL_XSD_TEST = 'https://wyszukiwarkaregontest.stat.gov.pl/wsBIR/wsdl/UslugaBIRzewnPubl.xsd';
    public const BASE_WSDL_SVC_TEST = 'https://wyszukiwarkaregontest.stat.gov.pl/wsBIR/UslugaBIRzewnPubl.svc';
    public const BASE_WSDL_XSD      = 'https://wyszukiwarkaregontest.stat.gov.pl/wsBIR/wsdl/UslugaBIRzewnPubl.xsd'; //taki sam jak do testowego
    public const BASE_WSDL_SVC      = 'https://wyszukiwarkaregon.stat.gov.pl/wsBIR/UslugaBIRzewnPubl.svc';
    public const BASE_WSDL_TEST_KEY = 'abcde12345abcde12345';


    public const PARAM_GETVALUE_STATUS_DATE_STATE = 'StanDanych';
    public const PARAM_GETVALUE_MESSAGE_CODE      = 'KomunikatKod';
    public const PARAM_GETVALUE_MESSAGE           = 'KomunikatTresc';
    public const PARAM_GETVALUE_SESSION_STATUS    = 'StatusSesji';
    public const PARAM_GETVALUE_SERVICE_STATUS    = 'StatusUslugi';
    public const PARAM_GETVALUE_SERVICE_MESSAGE   = 'KomunikatUslugi';
}
