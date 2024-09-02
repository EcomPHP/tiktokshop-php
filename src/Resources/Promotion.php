<?php
/*
 * This file is part of tiktok-shop.
 *
 * (c) Jin <j@sax.vn>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EcomPHP\TiktokShop\Resources;

use GuzzleHttp\RequestOptions;
use EcomPHP\TiktokShop\Resource;

class Promotion extends Resource
{
    protected $category = 'promotion';

    public function createActivity($title, $type, $begin_time, $end_time, $product_level)
    {
        return $this->call('POST', 'activities', [
            RequestOptions::JSON => [
                'title' => $title,
                'activity_type' => $type,
                'begin_time' => $begin_time,
                'end_time' => $end_time,
                'product_level' => $product_level,
            ]
        ]);
    }

    public function updateActivityProduct($activity_id, $products)
    {
        return $this->call('PUT', 'activities/'.$activity_id.'/products', [
            RequestOptions::JSON => [
                'products' => $products,
                'activity_id' => $activity_id,
            ]
        ]);
    }

    public function removeActivityProduct($activity_id, $product_ids = [], $sku_ids = [])
    {
        return $this->call('DELETE', 'activities/'.$activity_id.'/products', [
            RequestOptions::JSON => [
                'product_ids' => $product_ids,
                'sku_ids' => $sku_ids,
            ]
        ]);
    }

    public function searchActivities($params = [])
    {
        return $this->call('POST', 'activities/search', [
            RequestOptions::JSON => $params,
        ]);
    }

    public function getActivity($activity_id)
    {
        return $this->call('GET', 'activities/'.$activity_id);
    }

    public function updateActivity($activity_id, $title, $begin_time, $end_time)
    {
        return $this->call('PUT', 'activities/'.$activity_id, [
            RequestOptions::JSON => [
                'title' => $title,
                'begin_time' => $begin_time,
                'end_time' => $end_time,
            ]
        ]);
    }

    public function deactivateActivity($activity_id)
    {
        return $this->call('POST', 'activities/'.$activity_id.'/deactivate');
    }

    public function searchCoupons($query = [], $body = [])
    {
        return $this->call('POST', 'coupons/search', [
            RequestOptions::QUERY => $query,
            RequestOptions::JSON => $body,
        ]);
    }

    public function getCoupon($coupon_id)
    {
        return $this->call('GET', 'coupons/'.$coupon_id);
    }
}
