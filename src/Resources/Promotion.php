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

class Promotion extends Resource
{
    protected $prefix = 'promotion';

    public function updateBasicInformation($request_serial_no, $promotion_id, $title, $begin_time = null, $end_time = null)
    {
        $begin_time = $begin_time ?? time();
        $end_time = $end_time ?? time();

        return $this->call('POST', 'activity/update', [
            RequestOptions::JSON => [
                'promotion_id' => $promotion_id,
                'request_serial_no' => $request_serial_no,
                'title' => $title,
                'begin_time' => $begin_time,
                'end_time' => $end_time,
            ]
        ]);
    }

    public function getPromotionList($params = [])
    {
        $params = array_merge([
            'offset' => 0,
            'limit' => 20,
            'status' => 1, // upcoming
        ], $params);

        return $this->call('POST', 'activity/list', [
            RequestOptions::JSON => $params
        ]);
    }

    public function deactivatePromotion($request_serial_no, $promotion_id)
    {
        return $this->call('POST', 'activity/deactivate', [
            RequestOptions::JSON => [
                'promotion_id' => $promotion_id,
                'request_serial_no' => $request_serial_no,
            ]
        ]);
    }

    public function removePromotionItem($request_serial_no, $promotion_id, $spu_list = [], $sku_list = [])
    {
        $spu_list = is_array($spu_list) ? $spu_list : [$spu_list];
        $sku_list = is_array($sku_list)? $sku_list : [$sku_list];

        return $this->call('POST', 'activity/items/remove', [
            RequestOptions::JSON => [
                'promotion_id' => $promotion_id,
                'request_serial_no' => $request_serial_no,
                'sku_list' => $sku_list,
                'spu_list' => $spu_list,
            ]
        ]);
    }

    public function getPromotionDetail($promotion_id)
    {
        return $this->call('GET', 'activity/get', [
            RequestOptions::QUERY => [
                'promotion_id' => $promotion_id,
            ]
        ]);
    }

    public function addOrUpdateDiscountItem($request_serial_no, $promotion_id, $product_list)
    {
        $product_list = is_array($product_list) ? $product_list : [$product_list];

        return $this->call('POST', 'activity/items/addorupdate', [
            RequestOptions::JSON => [
                'promotion_id' => $promotion_id,
                'request_serial_no' => $request_serial_no,
                'product_list' => $product_list,
            ]
        ]);
    }

    public function addPromotion($request_serial_no, $promotion_id, $title, $begin_time = null, $end_time = null, $product_type = 1)
    {
        $begin_time = $begin_time ?? time();
        $end_time = $end_time ?? time();

        return $this->call('POST', 'activity/create', [
            RequestOptions::JSON => [
                'promotion_id' => $promotion_id,
                'request_serial_no' => $request_serial_no,
                'title' => $title,
                'begin_time' => $begin_time,
                'end_time' => $end_time,
                'product_type' => $product_type,
            ]
        ]);
    }
}
