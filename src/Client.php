<?php
/*
 * This file is part of tiktok-shop.
 *
 * (c) Jin <j@sax.vn>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NVuln\TiktokShop;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Middleware;
use GuzzleHttp\RequestOptions;
use NVuln\TiktokShop\Errors\TiktokShopException;
use NVuln\TiktokShop\Resources\Finance;
use NVuln\TiktokShop\Resources\Fulfillment;
use NVuln\TiktokShop\Resources\GlobalProduct;
use NVuln\TiktokShop\Resources\Logistic;
use NVuln\TiktokShop\Resources\Order;
use NVuln\TiktokShop\Resources\Product;
use NVuln\TiktokShop\Resources\Promotion;
use NVuln\TiktokShop\Resources\Reverse;
use NVuln\TiktokShop\Resources\Seller;
use NVuln\TiktokShop\Resources\Shop;
use NVuln\TiktokShop\Resources\Supplychain;
use Psr\Http\Message\RequestInterface;

/**
 * @property-read Shop $Shop
 * @property-read Seller $Seller
 * @property-read Product $Product
 * @property-read Order $Order
 * @property-read Fulfillment $Fulfillment
 * @property-read Logistic $Logistic
 * @property-read Reverse $Reverse
 * @property-read Finance $Finance
 * @property-read GlobalProduct $GlobalProduct
 * @property-read Promotion $Promotion
 * @property-read Supplychain $Supplychain
 */
class Client
{
    private CONST DEFAULT_VERSION = '202212';
    protected $app_key;
    protected $app_secret;
    protected $shop_id;
    protected $access_token;
    protected $sandbox;
    protected $version;

    /**
     * custom guzzle client options
     *
     * @var array
     * @see https://docs.guzzlephp.org/en/stable/request-options.html
     */
    protected $options;

    public const resources = [
        Shop::class,
        Seller::class,
        Product::class,
        Order::class,
        Fulfillment::class,
        Logistic::class,
        Reverse::class,
        Finance::class,
        GlobalProduct::class,
        Promotion::class,
        Supplychain::class,
    ];

    public function __construct($app_key, $app_secret, $shop_id = null, $sandbox = false, $version = self::DEFAULT_VERSION, $options = [])
    {
        $this->app_key = $app_key;
        $this->app_secret = $app_secret;
        $this->shop_id = $shop_id;
        $this->sandbox = $sandbox;
        $this->version = $version;
        $this->options = $options;
    }

    public function useSandboxMode()
    {
        $this->sandbox = true;
    }

    public function getAppKey()
    {
        return $this->app_key;
    }

    public function getAppSecret()
    {
        return $this->app_secret;
    }

    public function setAccessToken($access_token)
    {
        $this->access_token = $access_token;
    }

    public function setShopId($shop_id)
    {
        $this->shop_id = $shop_id;
    }

    public function auth()
    {
        return new Auth($this, $this->sandbox);
    }

    public function webhook()
    {
        $webhook = new Webhook($this);
        $webhook->verify();
        $webhook->capture();

        return $webhook;
    }

    protected function httpClient()
    {
        $stack = HandlerStack::create();
        $stack->push(Middleware::mapRequest(function (RequestInterface $request) {
            $uri = $request->getUri();
            parse_str($uri->getQuery(), $query);

            $query['app_key'] = $this->getAppKey();
            $query['timestamp'] = time();
            $query['version'] = $this->version;
            if ($this->shop_id && !isset($query['shop_id'])) {
                $query['shop_id'] = $this->shop_id;
            }

            if ($this->access_token && !isset($query['access_token'])) {
                $query['access_token'] = $this->access_token;
            }

            $this->prepareSignature($uri->getPath(), $query);

            $uri = $uri->withQuery(http_build_query($query));

            return $request->withUri($uri);
        }));

        $api_domain_endpoint = $this->sandbox ? 'open-api-sandbox.tiktokglobalshop.com' : 'open-api.tiktokglobalshop.com';

        $options = array_merge([
            RequestOptions::HTTP_ERRORS => false, // disable throw exception on http 4xx, manual handle it
            'handler' => $stack,
            'base_uri' => 'https://'.$api_domain_endpoint.'/api/',
        ], $this->options ?? []);

        return new GuzzleHttpClient($options);
    }

    /**
     * tiktokshop api signature algorithm
     * @see https://partner.tiktokshop.com/doc/page/274638
     *
     * @param $uri
     * @param $params
     * @return void
     */
    protected function prepareSignature($uri, &$params)
    {
        $paramsToBeSigned = $params;
        $stringToBeSigned = '';

        // 1. Extract all query param EXCEPT ' sign ', ' access_token ', reorder the params based on alphabetical order.
        unset($paramsToBeSigned['sign'], $paramsToBeSigned['access_token']);
        ksort($paramsToBeSigned);

        // 2. Concat all the param in the format of {key}{value}
        foreach ($paramsToBeSigned as $k => $v) {
            if (!is_array($v)) {
                $stringToBeSigned .= "$k$v";
            }
        }

        // 3. Append the request path to the beginning
        $stringToBeSigned = $uri . $stringToBeSigned;

        // 4. Wrap string generated in step 3 with app_secret.
        $stringToBeSigned = $this->getAppSecret() . $stringToBeSigned . $this->getAppSecret();

        // Encode the digest byte stream in hexadecimal and use sha256 to generate sign with salt(secret).
        $params['sign'] = hash_hmac('sha256', $stringToBeSigned, $this->getAppSecret());
    }

    /**
     * Magic call resource
     *
     * @param $resourceName
     * @throws TiktokShopException
     * @return mixed
     */
    public function __get($resourceName)
    {
        $resourceClassName = __NAMESPACE__."\\Resources\\".$resourceName;
        if (!in_array($resourceClassName, self::resources)) {
            throw new TiktokShopException("Invalid resource ".$resourceName);
        }

        //Initiate the resource object
        $resource = new $resourceClassName();
        if (!$resource instanceof Resource) {
            throw new TiktokShopException("Invalid resource class ".$resourceClassName);
        }

        $resource->useHttpClient($this->httpClient());

        return $resource;
    }

}
