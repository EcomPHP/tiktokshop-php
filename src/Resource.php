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
use NVuln\TiktokShop\Errors\RequestException;
use NVuln\TiktokShop\Errors\ResponseException;

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
        if ($code !== 0) {
            $this->handleErrorResponse($code, $json['message']);
        }

        if (is_array($json)) {
            return $json['data'];
        }

        return $response->getBody()->getContents();
    }

    protected function handleErrorResponse($code, $message)
    {
        throw new ResponseException($message, $code);
    }

    protected function checkRequiredParameters($params, $data = [])
    {
        foreach ($params as $param) {
            if (!isset($data[$param])) {
                throw new RequestException('Parameter `'.$param.'` is required.');
            }
        }
    }
}
