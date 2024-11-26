<?php
/*
 * This file is part of tiktokshop-php.
 *
 * Copyright (c) 2024 Jin <j@sax.vn> All rights reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EcomPHP\TiktokShop\Resources;

use EcomPHP\TiktokShop\Resource;
use GuzzleHttp\RequestOptions;

class Analytics extends Resource
{
    protected $category = 'analytics';
    protected $minimum_version = 202405;

    public function getShopPerformance($params = [])
    {
        return $this->call('GET', 'shop/performance', [
            RequestOptions::QUERY => $params,
        ]);
    }

    public function getShopProductPerformance($product_id, $params = [])
    {
        return $this->call('GET', 'shop_products/'. $product_id .'/performance', [
            RequestOptions::QUERY => $params,
        ]);
    }

    public function getShopProductPerformanceList($params = [])
    {
        return $this->call('GET', 'shop_products/performance', [
            RequestOptions::QUERY => $params,
        ]);
    }

    public function getShopSkuPerformance($sku_id, $params = [])
    {
        return $this->call('GET', 'shop_skus/'. $sku_id .'/performance', [
            RequestOptions::QUERY => $params,
        ]);
    }

    public function getShopSkuPerformanceList($params = [])
    {
        return $this->call('GET', 'shop_skus/performance', [
            RequestOptions::QUERY => $params,
        ]);
    }

    public function getShopVideoPerformanceList($params = [])
    {
        return $this->call('GET', 'shop_videos/performance', [
            RequestOptions::QUERY => $params,
        ]);
    }

    public function getShopVideoPerformanceOverview($params = [])
    {
        return $this->call('GET', 'shop_videos/overview_performance', [
            RequestOptions::QUERY => $params,
        ]);
    }

    public function getShopVideoPerformance($video_id, $params = [])
    {
        return $this->call('GET', 'shop_videos/'. $video_id .'/performance', [
            RequestOptions::QUERY => $params,
        ]);
    }

    public function getShopVideoProductPerformanceList($video_id, $params = [])
    {
        return $this->call('GET', 'shop_videos/'. $video_id .'/products/performance', [
            RequestOptions::QUERY => $params,
        ]);
    }
}
