
[![Latest Stable Version](https://img.shields.io/github/release/mrcnpdlk/regon-api.svg)](https://packagist.org/packages/mrcnpdlk/regon-api)
[![Latest Unstable Version](https://poser.pugx.org/mrcnpdlk/regon-api/v/unstable.png)](https://packagist.org/packages/mrcnpdlk/regon-api)
[![Total Downloads](https://img.shields.io/packagist/dt/mrcnpdlk/regon-api.svg)](https://packagist.org/packages/mrcnpdlk/regon-api)
[![Monthly Downloads](https://img.shields.io/packagist/dm/mrcnpdlk/regon-api.svg)](https://packagist.org/packages/mrcnpdlk/regon-api)
[![License](https://img.shields.io/packagist/l/mrcnpdlk/regon-api.svg)](https://packagist.org/packages/mrcnpdlk/regon-api)    

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/mrcnpdlk/regon-api/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mrcnpdlk/regon-api/?branch=master) 
[![Build Status](https://scrutinizer-ci.com/g/mrcnpdlk/regon-api/badges/build.png?b=master)](https://scrutinizer-ci.com/g/mrcnpdlk/regon-api/build-status/master)
[![Code Coverage](https://scrutinizer-ci.com/g/mrcnpdlk/regon-api/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/mrcnpdlk/regon-api/?branch=master)

[![Code Climate](https://codeclimate.com/github/mrcnpdlk/regon-api/badges/gpa.svg)](https://codeclimate.com/github/mrcnpdlk/regon-api) 
[![Issue Count](https://codeclimate.com/github/mrcnpdlk/regon-api/badges/issue_count.svg)](https://codeclimate.com/github/mrcnpdlk/regon-api)


[![Dependency Status](https://www.versioneye.com/user/projects/59bae8ff0fb24f0056dfc148/badge.svg)](https://www.versioneye.com/user/projects/59bae8ff0fb24f0056dfc148)

# REGON API - Polish companies database

## Installation

Install the latest version with [composer](https://packagist.org/packages/mrcnpdlk/regon-api)
```bash
composer require mrcnpdlk/regon-api
```

## Basic usage

### Cache
Library supports Cache bundles based on [PSR-16](http://www.php-fig.org/psr/psr-16/) standard.

For below example was used [phpfastcache/phpfastcache](https://github.com/PHPSocialNetwork/phpfastcache).
`phpfastcache/phpfastcache` supports a lot of endpoints, i.e. `Files`, `Sqlite`, `Redis` and many other. 
More information about using cache and configuration it you can find in this [Wiki](https://github.com/PHPSocialNetwork/phpfastcache/wiki). 

```php

    /**
     * Cache in system files
     */
    $oInstanceCacheFiles = new \phpFastCache\Helper\Psr16Adapter(
        'files',
        [
            'defaultTtl' => 3600 * 24, // 24h
            'path'       => sys_get_temp_dir(),
        ]);
    /**
     * Cache in Redis
     */
    $oInstanceCacheRedis = new \phpFastCache\Helper\Psr16Adapter(
        'redis',
        [
            "host"                => null, // default localhost
            "port"                => null, // default 6379
            'defaultTtl'          => 3600 * 24, // 24h
            'ignoreSymfonyNotice' => true,
        ]);

```

### Log

Library also supports logging packages based on [PSR-3](http://www.php-fig.org/psr/psr-3/) standard, i.e. very popular
[monolog/monolog](https://github.com/Seldaek/monolog).

```php

$oInstanceLogger = new \Monolog\Logger('name_of_my_logger');
$oInstanceLogger->pushHandler(new \Monolog\Handler\ErrorLogHandler(
        \Monolog\Handler\ErrorLogHandler::OPERATING_SYSTEM,
        \Psr\Log\LogLevel::DEBUG
    )
);

```

### REGON Authentication
Service REGON shares API based on `SOAP Protocol`. More information about service you can find on 
this [site](http://bip.stat.gov.pl/dzialalnosc-statystyki-publicznej/rejestr-regon/interfejsyapi/jak-skorzystac-informacja-dla-podmiotow-komercyjnych/)
There are two ways to connect to the server:
 - `production database` - you need API Key
 - `testing database` - default authentication with default API Key

First of all we need configure connection calling `setConfig()` method and 
optionally set cache and log instances

```php
use mrcnpdlk\Regon\Client;

$oClient = new \mrcnpdlk\Regon\Client();
$oClient
    ->setCacheInstance($oInstanceCacheRedis)
    ->setLoggerInstance($oInstanceLogger)
    //->setConfig('API_KEY',true)
;
```

After that we able to call auxiliary methods defined in NativeApi class, i.e:
```php
$oNativeApi = \mrcnpdlk\Regon\NativeApi::create($oClient); //inject Client handler
```

## Defined methods (NativeApi)
All methods from official documentation have been mapped and defined.

Full list below:

| Method | Status | Description|
| ------ | ------ |------ |
|`Zaloguj()`|:ok_hand:||
|`Wyloguj()`|:ok_hand:||
|`GetValue()`|:ok_hand:||
|`DaneSzukaj()`|:ok_hand:||
|`DanePobierzPelnyRaport()`|:ok_hand:||

## Defined methods (Api)

```php
$oApi = new \mrcnpdlk\Regon\Api($oClient); //inject Client handler
$oEntity = $oApi->getReport('');
```

| Method | Status | Description|
| ------ | ------ |------ |
|`getByNip($nip)`|:ok_hand:|return `mrcnpdlk\Regon\Model\SearchResult` object|
|`getByKrs($krs)`|:ok_hand:|return `mrcnpdlk\Regon\Model\SearchResult` object|
|`getByRegon($regon)`|:ok_hand:|return `mrcnpdlk\Regon\Model\SearchResult` object|
|`getServiceStatus()`|:ok_hand:||
|`getReport($regon)`|:ok_hand:|return `mrcnpdlk\Regon\Model\Entity` object|

## Response example
```php
mrcnpdlk\Regon\Model\Entity Object
(
    [basicLegalFormId] => 2
    [basicLegalFormName] => JEDNOSTKA ORGANIZACYJNA NIEMAJĄCA OSOBOWOŚCI PRAWNEJ
    [detailedLegalFormId] => 401
    [detailedLegalFormName] => ORGANY WŁADZY, ADMINISTRACJI RZĄDOWEJ
    [isActive] => 1
    [regon] => 00033150100000
    [regon9] => 000331501
    [nip] => 5261040828
    [krs] => 
    [ceidg] => 
    [register] => mrcnpdlk\Regon\Model\Entity\Register Object
        (
            [nr] => 
            [typeId] => 000
            [typeName] => PODMIOTY UTWORZONE Z MOCY USTAWY
            [dateAdd] => 
        )

    [name] => GŁÓWNY URZĄD STATYSTYCZNY
    [nameShort] => GUS
    [owner] => 
    [history] => mrcnpdlk\Regon\Model\Entity\Date Object
        (
            [add] => 
            [create] => 1975-12-15
            [start] => 1975-12-15
            [suspend] => 
            [resume] => 
            [change] => 2013-04-22
            [close] => 
            [delete] => 
        )

    [departmentsCount] => 0
    [addressHead] => mrcnpdlk\Regon\Model\Entity\Address Object
        (
            [countryId] => PL
            [countryName] => POLSKA
            [provinceId] => 14
            [provinceName] => MAZOWIECKIE
            [districtId] => 65
            [districtName] => m. st. Warszawa
            [communeId] => 10
            [communeTypeId] => 8
            [communeName] => Śródmieście
            [postalCode] => 00925
            [cityId] => 0919810
            [cityName] => Warszawa
            [postalCityId] => 0919810
            [postalCityName] => Warszawa
            [streetId] => 38299
            [streetName] => Aleja Niepodległości
            [homeNr] => 208
            [flatNr] => 
        )

    [addressCorr] => 
    [contactPhone] => 6083000
    [contactEmail] => dgsek@stat.gov.pl
    [availableReports] => 
    [locals] => Array
        (
        )

    [mainEntity] => 
)
```
