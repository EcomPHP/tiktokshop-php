<?php
/*
 * This file is part of tiktokshop-client.
 *
 * Copyright (c) 2023 Jin <j@sax.vn> All rights reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EcomPHP\TiktokShop\Tests\Resources;

use EcomPHP\TiktokShop\Tests\TestResource;

/**
 * @property-read \EcomPHP\TiktokShop\Resources\Logistic $caller
 */
class LogisticTest extends TestResource
{

    public function testGetGlobalSellerWarehouse()
    {
        $this->caller->getGlobalSellerWarehouse();
        $this->assertPreviousRequest('GET', 'logistics/'.TestResource::TEST_API_VERSION.'/global_warehouses');
    }

    public function testGetShippingProvider()
    {
        $delivery_option_id = 200002;
        $this->caller->getShippingProvider($delivery_option_id);
        $this->assertPreviousRequest('GET', 'logistics/'.TestResource::TEST_API_VERSION.'/delivery_options/'.$delivery_option_id.'/shipping_providers');
    }

    public function testGetWarehouseDeliveryOptions()
    {
        $warehouse_id = 200001;
        $this->caller->getWarehouseDeliveryOptions($warehouse_id);
        $this->assertPreviousRequest('GET', 'logistics/'.TestResource::TEST_API_VERSION.'/warehouses/'.$warehouse_id.'/delivery_options');
    }

    public function testGetWarehouseList()
    {
        $this->caller->getWarehouseList();
        $this->assertPreviousRequest('GET', 'logistics/'.TestResource::TEST_API_VERSION.'/warehouses');
    }
}
