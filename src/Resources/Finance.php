<?php
/*
 * This file is part of tiktok-shop.
 *
 * (c) Jin <j@sax.vn>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NVuln\TiktokShop\Resources;

use GuzzleHttp\RequestOptions;
use NVuln\TiktokShop\Resource;

class Finance extends Resource
{
    protected $prefix = 'finance';

    public function getSettlements($params = [])
    {
        $params = array_merge([
            'page_size' => 20,
        ], $params);

        return $this->call('POST', 'settlements/search', [
            RequestOptions::JSON => $params
        ]);
    }

    public function getTransactions($params = [])
    {
        $params = array_merge([
            'page_size' => 20,
            'offset' => 0,
        ], $params);

        return $this->call('POST', 'transactions/search', [
            RequestOptions::JSON => $params
        ]);
    }

    public function getOrderSettlements($order_id)
    {
        return $this->call('GET', 'order/settlements', [
            RequestOptions::QUERY => [
                'order_id' => $order_id
            ]
        ]);
    }
}
