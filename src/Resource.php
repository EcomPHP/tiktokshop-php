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

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use NVuln\TiktokShop\Errors\ResponseException;
use NVuln\TiktokShop\Errors\TokenException;

abstract class Resource
{
    /** @var Client */
    protected $httpClient;

    protected $prefix = '';

    protected $last_message = null;

    protected $last_request_id = null;

    public function useHttpClient(Client $client)
    {
        $this->httpClient = $client;
    }

    /**
     * @throws \NVuln\TiktokShop\Errors\TiktokShopException
     */
    public function call($method, $action, $params = [])
    {
        $uri = trim($this->prefix.'/'.$action, '/');
        try {
            $response = $this->httpClient->request($method, $uri, $params);
        } catch (GuzzleException $e) {
            throw new ResponseException($e->getMessage(), $e->getCode(), $e);
        }

        $json = json_decode($response->getBody()->getContents(), true);
        if ($json === null) {
            throw new ResponseException('Unable to parse response string as JSON');
        }

        $this->last_message = $json['message'] ?? null;
        $this->last_request_id = $json['request_id'] ?? null;

        $code = $json['code'] ?? -1;
        if ($code !== 0) {
            $this->handleErrorResponse($code, $json['message']);
        }

        return $json['data'] ?? [];
    }

    public function getLastMessage()
    {
        return $this->last_message;
    }

    public function getLastRequestId()
    {
        return $this->last_request_id;
    }

    protected function handleErrorResponse($code, $message)
    {
        // get 3 first digit as the error code group
        // more detail: https://partner.tiktokshop.com/doc/page/234136
        $errorGroup = substr(strval($code), 0, 3);

        // token error
        if ($errorGroup == '105') {
            throw new TokenException($message, $code);
        }

        throw new ResponseException($message, $code);
    }
}
