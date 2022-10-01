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
use NVuln\TiktokShop\Errors\ResponseException;
use NVuln\TiktokShop\Errors\TokenException;

abstract class Resource
{
    /** @var Client */
    protected $httpClient;

    protected $prefix = '';

    public function useHttpClient(Client $client)
    {
        $this->httpClient = $client;
    }

    public function call($method, $action, $params = [])
    {
        $response = $this->httpClient->request($method, $this->prefix.'/'.$action, $params);
        $json = json_decode($response->getBody()->getContents(), true);
        $code = $json['code'] ?? -1;
        if (is_array($json) && $code !== 0) {
            $this->handleErrorResponse($code, $json['message']);
        }

        if (is_array($json)) {
            return $json['data'];
        }

        return $response->getBody()->getContents();
    }

    protected function handleErrorResponse($code, $message)
    {
        // get 3 first digit as the error code group
        // more detail: https://developers.tiktok-shops.com/documents/document/234136
        $errorGroup = floor($code / 1000);

        // token error
        if ($errorGroup == 105) {
            throw new TokenException($message, $code);
        }

        throw new ResponseException($message, $code);
    }
}
