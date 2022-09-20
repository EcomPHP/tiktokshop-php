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

class Reverse extends Resource
{
    protected $prefix = 'reverse';

    public function getRejectReasonList($params = [])
    {
        return $this->call('GET', 'reverse_reason/list', [
            RequestOptions::QUERY => $params
        ]);
    }

    public function getReverseOrderList($params = [])
    {
        $params = array_merge([
            'size' => 20,
            'offset' => 0,
        ], $params);

        return $this->call('POST', 'reverse_order/list', [
            RequestOptions::JSON => $params
        ]);
    }

    public function rejectReverseRequest($reverse_order_id, $reverse_reject_reason_key, $reverse_reject_comments = '')
    {
        return $this->call('POST', 'reverse_request/reject', [
            RequestOptions::JSON => [
                'reverse_order_id' => $reverse_order_id,
                'reverse_reject_reason_key' => $reverse_reject_reason_key,
                'reverse_reject_comments' => $reverse_reject_comments
            ]
        ]);
    }

    public function confirmReverseRequest($reverse_order_id)
    {
        return $this->call('POST', 'reverse_request/confirm', [
            RequestOptions::JSON => [
                'reverse_order_id' => $reverse_order_id,
            ]
        ]);
    }

    public function cancelOrder($order_id, $cancel_reason_key)
    {
        return $this->call('POST', 'order/cancel', [
            RequestOptions::JSON => [
                'order_id' => $order_id,
                'cancel_reason_key' => $cancel_reason_key,
            ]
        ]);
    }
}
