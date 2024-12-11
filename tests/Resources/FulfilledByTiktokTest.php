<?php

namespace EcomPHP\TiktokShop\Tests\Resources;

use EcomPHP\TiktokShop\Tests\TestResource;

class FulfilledByTiktokTest extends TestResource
{
    public const TEST_API_VERSION = 202408;

    public function testGetFbtMerchantOnboardedRegions()
    {
        $this->caller->getFbtMerchantOnboardedRegions();
        $this->assertPreviousRequest('GET', 'fbt/202409/merchants/onboarded_regions');
    }

    public function getFbtWarehouseList()
    {
        $this->caller->getFbtWarehouseList();
        $this->assertPreviousRequest('GET', 'fbt/' . self::TEST_API_VERSION . '/warehouses');
    }

    public function getInboundOrder()
    {
        $this->caller->getInboundOrder([]);
        $this->assertPreviousRequest('GET', 'fbt/202409/inbound_orders');
    }

    public function testSearchFbtInventory()
    {
        $this->caller->searchFbtInventory();
        $this->assertPreviousRequest('POST', 'fbt/' . self::TEST_API_VERSION . '/inventory/search');
    }

    public function testSearchFbtInventoryRecord()
    {
        $this->caller->searchFbtInventoryRecord();
        $this->assertPreviousRequest('POST', 'fbt/202410/inventory_records/search');
    }

    public function testSearchGoodsInfo()
    {
        $this->caller->searchGoodsInfo();
        $this->assertPreviousRequest('POST', 'fbt/202409/goods/search');
    }
}