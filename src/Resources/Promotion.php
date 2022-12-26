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

    public const STATUS_UPCOMING = 1;
    public const STATUS_ONGOING = 2;
    public const STATUS_EXPIRED = 3;
    public const STATUS_DEACTIVATED = 4;

    public function updateBasicInformation($request_serial_no, $promotion_id, $title, $begin_time = null, $end_time = null)
    {
        return $this->call('POST', 'activity/update', [
            RequestOptions::JSON => [
                'promotion_id' => $promotion_id,
                'request_serial_no' => $request_serial_no,
                'title' => $title,
                'begin_time' => static::dataTypeCast('timestamp', $begin_time),
                'end_time' => static::dataTypeCast('timestamp', $end_time),
            ]
        ]);
    }

    public function getPromotionList($params = [])
    {
        $params = array_merge([
            'offset' => 0,
            'limit' => 20,
            'status' => static::STATUS_UPCOMING, // upcoming
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
        return $this->call('POST', 'activity/items/remove', [
            RequestOptions::JSON => [
                'promotion_id' => $promotion_id,
                'request_serial_no' => $request_serial_no,
                'sku_list' => static::dataTypeCast('array', $sku_list),
                'spu_list' => static::dataTypeCast('array', $spu_list),
            ]
        ]);
    }

    public function getPromotionDetail($promotion_id)
    {
        return $this->call('GET', 'activity/get', [
            RequestOptions::QUERY => [
                'promotion_id' => static::dataTypeCast('string', $promotion_id),
            ]
        ]);
    }

    public function addOrUpdateDiscountItem($request_serial_no, $promotion_id, $product_list)
    {
        return $this->call('POST', 'activity/items/addorupdate', [
            RequestOptions::JSON => [
                'promotion_id' => $promotion_id,
                'request_serial_no' => $request_serial_no,
                'product_list' => static::dataTypeCast('array', $product_list),
            ]
        ]);
    }

    public function addPromotion($request_serial_no, $title, $begin_time = null, $end_time = null, $product_type = 1, $promotion_type = 1)
    {
        return $this->call('POST', 'activity/create', [
            RequestOptions::JSON => [
                'request_serial_no' => $request_serial_no,
                'title' => $title,
                'begin_time' => static::dataTypeCast('timestamp', $begin_time),
                'end_time' => static::dataTypeCast('timestamp', $end_time),
                'product_type' => $product_type,
                'promotion_type' => $promotion_type,
            ]
        ]);
    }
}
