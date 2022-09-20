## Configure TiktokShop PHP Client

```php
use NVuln\TiktokShop\Client;

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
$token = $auth->getToken($request->code);

$access_token = $token['access_token'];
$refresh_token = $token['refresh_token'];
```

3) Get authorized Shop ID

```php
$access_token = $token['access_token'];
$client->setAccessToken($access_token);

$authorizedShopList = $client->Shop->getAuthorizedShop();

// extract shop_id from $authorizedShopList
```

## Usage API Example

> You need `access_token` and `shop_id` to start using TiktokShop API

```php
$client = new Client($app_key, $app_secret);
$client->setAccessToken($access_token);
$client->setShopId($shop_id);
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
