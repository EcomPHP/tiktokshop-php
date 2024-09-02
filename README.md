# TiktokShop API Client in PHP

[![Total Downloads](https://poser.pugx.org/ecomphp/tiktokshop-php/downloads)](https://packagist.org/packages/ecomphp/tiktokshop-php) 
[![Latest Stable Version](https://poser.pugx.org/ecomphp/tiktokshop-php/v/stable)](https://packagist.org/packages/ecomphp/tiktokshop-php) 
[![Latest Unstable Version](https://poser.pugx.org/ecomphp/tiktokshop-php/v/unstable)](https://packagist.org/packages/ecomphp/tiktokshop-php)
[![Build Status](https://img.shields.io/github/actions/workflow/status/ecomphp/tiktokshop-php/ci.yml?branch=master&label=ci%20build&style=flat-square)](https://github.com/ecomphp/tiktokshop-php/actions?query=workflow%3ATest)
[![License](https://poser.pugx.org/ecomphp/tiktokshop-php/license)](https://packagist.org/packages/ecomphp/tiktokshop-php)

Tiktok Shop API Client is a simple SDK implementation of Tiktok Shop API.

Since v2.x, library used API version 202309 and later. For older API version, please use v1.x

## Installation

Install with Composer

```shell
composer require ecomphp/tiktokshop-php
```

## Configure TiktokShop PHP Client

```php
use EcomPHP\TiktokShop\Client;

$app_key = 'your app key';
$app_secret = 'your app secret';

$client = new Client($app_key, $app_secret);
```

## Grant token

There is a Auth class to help you getting the token from the shop using oAuth.

```php
$auth = $client->auth();
```

1) Create the authentication request

```php
$_SESSION['state'] = $state = str_random(40); // random string
$auth->createAuthRequest($state);
```

> If you want the function to return the authentication url instead of auto-redirecting, you can set the argument $return (2nd argument) to true.

```php
$authUrl = $auth->createAuthRequest($state, true);

// redirect user to auth url
header('Location: '.$authUrl);
```

2) Get authentication code when redirected back to `Redirect callback URL` after app authorization and exchange it for access token

```php
$authorization_code = $_GET['code'];
$token = $auth->getToken($authorization_code);

$access_token = $token['access_token'];
$refresh_token = $token['refresh_token'];
```

3) Get authorized Shop cipher

```php
$access_token = $token['access_token'];
$client->setAccessToken($access_token);

$authorizedShopList = $client->Authorization->getAuthorizedShop();

// extract shop_id & cipher from $authorizedShopList for use later
```

## Refresh your access token

> Access token will be expired soon, so you need refresh new token by using `refresh_token`

```php
$new_token = $auth->refreshNewToken($refresh_token);

$new_access_token = $new_token['access_token'];
$new_refresh_token = $new_token['refresh_token'];
```
## Usage API Example

> You need `access_token` and `shop_cipher` to start using TiktokShop API

```php
$client = new Client($app_key, $app_secret);
$client->setAccessToken($access_token);
$client->setShopCipher($shop_cipher);
```

* Get product list: [api document](https://developers.tiktok-shops.com/documents/document/237487)

```php
$products = $client->Product->getProductList([
    'page_size' => 50,
]);
```

* Get order list: [api document](https://developers.tiktok-shops.com/documents/document/237434)

```php
$orders = $client->Order->getOrderList([
    'order_status' => 100, // Unpaid order
    'page_size' => 50,
]);
```

## Change API version

> As default, API version 202309 will be used in every api call. Use example below to change it

```php
$products = $client->Product->useVersion('202312')->checkListingPrerequisites(); 
```

## Webhook

Use webhook to receive incoming notification from tiktok shop

```php
$webhook = $client->webhook();
```

or manually configure the webhook receiver

```php
use EcomPHP\TiktokShop\Webhook;
use EcomPHP\TiktokShop\Errors\TiktokShopException;

$webhook = new Webhook($client);
try {
    $webhook->verify();
    $webhook->capture($_POST);
} catch (TiktokShopException $e) {
    echo "webhook error: " . $e->getMessage() . "\n";
}
```

```php
echo "Type: " . $webhook->getType() . "\n";
echo "Timestamp: " . $webhook->getTimestamp() . "\n";
echo "Shop ID: " . $webhook->getShopId() . "\n";
echo "Data: \n"; // data is array
print_r($webhook->getData());

```
