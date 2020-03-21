
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

## Basic usage

```php
$oConfig = new Mrcnpdlk\Api\Regon\Config([
    'password' => 'my_password',
]);

$oNativeApi = new \Mrcnpdlk\Api\Regon\NativeApi($oConfig);
$oApi = new \Mrcnpdlk\Api\Regon\Api($oConfig);
```

## NativeApi



## Api
