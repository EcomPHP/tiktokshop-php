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

class Order extends Resource
{
    protected $prefix = 'orders';

    public function getOrderDetail($order_id_list = [])
    {
        $order_id_list = is_array($order_id_list) ? $order_id_list : [$order_id_list];

        return $this->call('POST', 'detail/query', [
            RequestOptions::JSON => [
                'order_id_list' => $order_id_list,
            ]
        ]);
    }

    public function getOrderList($params = [])
    {
        $params = array_merge([
            'page_size' => 20,
        ], $params);

        return $this->call('POST', 'search', [
            RequestOptions::JSON => $params,
        ]);
    }
}
