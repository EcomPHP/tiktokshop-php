<?php
/*
 * This file is part of tiktokshop-php.
 *
 * Copyright (c) 2024 Jin <j@sax.vn> All rights reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EcomPHP\TiktokShop\Tests\Resources;

use EcomPHP\TiktokShop\Resources\Analytics;
use EcomPHP\TiktokShop\Tests\TestResource;

/**
 * @property-read \EcomPHP\TiktokShop\Resources\Analytics $caller
 */
class AnalyticsTest extends TestResource
{
    public const TEST_API_VERSION = 202405;

    public function testGetShopPerformance()
    {
        $this->caller->getShopPerformance();
        $this->assertPreviousRequest('GET', 'analytics/'.self::TEST_API_VERSION.'/shop/performance');
    }

    public function testGetShopProductPerformance()
    {
        $this->caller->getShopProductPerformance(123);
        $this->assertPreviousRequest('GET', 'analytics/'.self::TEST_API_VERSION.'/shop_products/123/performance');
    }

    public function testGetShopProductPerformanceList()
    {
        $this->caller->getShopProductPerformanceList();
        $this->assertPreviousRequest('GET', 'analytics/'.self::TEST_API_VERSION.'/shop_products/performance');
    }

    public function testGetShopSkuPerformance()
    {
        $this->caller->getShopSkuPerformance(123);
        $this->assertPreviousRequest('GET', 'analytics/'.self::TEST_API_VERSION.'/shop_skus/123/performance');
    }

    public function testGetShopSkuPerformanceList()
    {
        $this->caller->getShopSkuPerformanceList();
        $this->assertPreviousRequest('GET', 'analytics/'.self::TEST_API_VERSION.'/shop_skus/performance');
    }

    public function testGetShopVideoPerformance()
    {
        $this->caller->getShopVideoPerformance(123);
        $this->assertPreviousRequest('GET', 'analytics/'.self::TEST_API_VERSION.'/shop_videos/123/performance');

    }

    public function testGetShopVideoPerformanceList()
    {
        $this->caller->getShopVideoPerformanceList();
        $this->assertPreviousRequest('GET', 'analytics/'.self::TEST_API_VERSION.'/shop_videos/performance');
    }

    public function testGetShopVideoPerformanceOverview()
    {
        $this->caller->getShopVideoPerformanceOverview();
        $this->assertPreviousRequest('GET', 'analytics/'.self::TEST_API_VERSION.'/shop_videos/overview_performance');
    }

    public function testGetShopVideoProductPerformanceList()
    {
        $this->caller->getShopVideoProductPerformanceList(123);
        $this->assertPreviousRequest('GET', 'analytics/'.self::TEST_API_VERSION.'/shop_videos/123/products/performance');
    }
}
