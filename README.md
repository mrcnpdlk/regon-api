
[![Latest Stable Version](https://img.shields.io/github/release/mrcnpdlk/regon-api.svg)](https://packagist.org/packages/mrcnpdlk/regon-api)
[![Latest Unstable Version](https://poser.pugx.org/mrcnpdlk/regon-api/v/unstable.png)](https://packagist.org/packages/mrcnpdlk/regon-api)
[![Total Downloads](https://img.shields.io/packagist/dt/mrcnpdlk/regon-api.svg)](https://packagist.org/packages/mrcnpdlk/regon-api)
[![Monthly Downloads](https://img.shields.io/packagist/dm/mrcnpdlk/regon-api.svg)](https://packagist.org/packages/mrcnpdlk/regon-api)
[![License](https://img.shields.io/packagist/l/mrcnpdlk/regon-api.svg)](https://packagist.org/packages/mrcnpdlk/regon-api)    

# REGON API - Polish companies database v2

## Installation

Install the latest version with [composer](https://packagist.org/packages/mrcnpdlk/regon-api)
```bash
composer require mrcnpdlk/regon-api
```

API uses [BIR 1.1](https://api.stat.gov.pl/Home/RegonApi)

## Basic usage

### Configuration
Available options:

| Parameter name | Description           | Is required |
| -------------- | --------------------- | ----------- |
| password       | Password to REGON api | YES         |
| wsdl           | path to WSDL          | NO          |
| location       | path do SVC location  | NO          |

### Creating instance

```php
$oConfig = new Mrcnpdlk\Api\Regon\Config([
    'password' => 'my_password',
]);

$oNativeApi = new \Mrcnpdlk\Api\Regon\NativeApi($oConfig);
$oApi = new \Mrcnpdlk\Api\Regon\Api($oConfig);
```

## NativeApi

`NativeApi` class implements native GUS methods such like:

- Zaloguj()
- Wyloguj()
- GetValue(ValueEnum $param)
- DaneSzukajPodmioty( string $regon = null, string $nip = null, string $krs = null, array $tRegon = [], array $tNip = [], array $tKrs = [])
- DanePobierzRaportZbiorczy(string $date, ReportCompactEnum $report)
- DanePobierzPelnyRaport(string $regon, ReportFullEnum $report)

## Api

`Api` class implements usable methods based on `NativeApi` class.

- searchByNip()
- searchByKrs()
- searchByRegon()
- getPKD()
- getReport()