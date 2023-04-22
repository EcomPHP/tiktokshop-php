<?php
/*
 * This file is part of tiktokshop-client.
 *
 * (c) Jin <j@sax.vn>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NVuln\TiktokShop;

use NVuln\TiktokShop\Errors\TiktokShopException;

class Webhook
{
    public const ORDER_STATUS_UPDATE = 1;
    public const REVERSE_ORDER_STATUS_UPDATE = 2;
    public const RECIPIENT_ADDRESS_UPDATE = 3;
    public const PACKAGE_UPDATE = 4;
    public const PRODUCT_AUDIT_RESULT_UPDATE = 5;

    /**
     * @var Client
     */
    protected $client;

    protected $type;
    protected $shop_id;
    protected $data;
    protected $timestamp;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getShopId()
    {
        return $this->shop_id;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }

    public function capture($params = null)
    {
        if ($params === null) {
            $rawData = file_get_contents('php://input');
            $params = json_decode($rawData, true);
        }

        if (!is_array($params)) {
            throw new TiktokShopException("Incoming webhook request data invalid.");
        }

        $this->type = $params['type'];
        $this->shop_id = $params['shop_id'];
        $this->data = $params['data'];
        $this->timestamp = $params['timestamp'];
    }

    public function verify($signature = null, $rawData = null, $throw = true)
    {
        $signature = $signature ?? self::getAuthorizationHeader();
        $rawData = $rawData ?? file_get_contents('php://input');

        $stringToBeSigned = $this->client->getAppKey() . $rawData;
        $sign = hash_hmac('sha256', $stringToBeSigned, $this->client->getAppSecret());

        $verified = hash_equals($sign, $signature);

        if ($throw && !$verified) {
            throw new TiktokShopException("Incoming webhook request invalid. Signature not match.");
        }

        return $verified;
    }

    private static function getAuthorizationHeader()
    {
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        } elseif (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));

            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }

        return $headers;
    }
}
