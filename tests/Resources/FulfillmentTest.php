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
 * @property-read \EcomPHP\TiktokShop\Resources\Fulfillment $caller
 */
class FulfillmentTest extends TestResource
{

    public function testGetPackageShippingDocument()
    {
        $package_id = 200001;
        $this->caller->getPackageShippingDocument($package_id, 'SHIPPING_LABEL');
        $this->assertPreviousRequest('GET', 'fulfillment/'.TestResource::TEST_API_VERSION.'/packages/'.$package_id.'/shipping_documents');
    }

    public function testGetPackageHandoverTimeSlots()
    {
        $package_id = 200001;
        $this->caller->getPackageHandoverTimeSlots($package_id);
        $this->assertPreviousRequest('GET', 'fulfillment/'.TestResource::TEST_API_VERSION.'/packages/'.$package_id.'/handover_time_slots');
    }

    public function testUpdatePackageDeliveryStatus()
    {
        $this->caller->updatePackageDeliveryStatus();
        $this->assertPreviousRequest('POST', 'fulfillment/'.TestResource::TEST_API_VERSION.'/packages/deliver');
    }

    public function testSearchCombinablePackages()
    {
        $this->caller->searchCombinablePackages();
        $this->assertPreviousRequest('GET', 'fulfillment/'.TestResource::TEST_API_VERSION.'/combinable_packages/search');
    }

    public function testSearchPackage()
    {
        $this->caller->searchPackage();
        $this->assertPreviousRequest('POST', 'fulfillment/'.TestResource::TEST_API_VERSION.'/packages/search');
    }

    public function testCombinePackage()
    {
        $this->caller->combinePackage([]);
        $this->assertPreviousRequest('POST', 'fulfillment/'.TestResource::TEST_API_VERSION.'/packages/combine');
    }

    public function testFulfillmentUploadDeliveryFile()
    {
        $this->caller->fulfillmentUploadDeliveryFile('php://memory');
        $this->assertPreviousRequest('POST', 'fulfillment/'.TestResource::TEST_API_VERSION.'/files/upload');
    }

    public function testUpdateShippingInfo()
    {
        $order_id = 10002;
        $this->caller->updateShippingInfo($order_id, 'tracking number', 200001);
        $this->assertPreviousRequest('POST', 'fulfillment/'.TestResource::TEST_API_VERSION.'/orders/'.$order_id.'/shipping_info/update');
    }

    public function testMarkPackageAsShipped()
    {
        $order_id = 10002;
        $this->caller->markPackageAsShipped($order_id, 'tracking number', 200001);
        $this->assertPreviousRequest('POST', 'fulfillment/'.TestResource::TEST_API_VERSION.'/orders/'.$order_id.'/packages');
    }

    public function testGetTracking()
    {
        $order_id = 10002;
        $this->caller->getTracking($order_id);
        $this->assertPreviousRequest('GET', 'fulfillment/'.TestResource::TEST_API_VERSION.'/orders/'.$order_id.'/tracking');
    }

    public function testGetOrderSplitAttributes()
    {
        $this->caller->getOrderSplitAttributes([]);
        $this->assertPreviousRequest('GET', 'fulfillment/'.TestResource::TEST_API_VERSION.'/orders/split_attributes');
    }

    public function testUncombinePackages()
    {
        $package_id = 200001;
        $this->caller->uncombinePackages($package_id);
        $this->assertPreviousRequest('POST', 'fulfillment/'.TestResource::TEST_API_VERSION.'/packages/'.$package_id.'/uncombine');
    }

    public function testGetPackageDetail()
    {
        $package_id = 200001;
        $this->caller->getPackageDetail($package_id);
        $this->assertPreviousRequest('GET', 'fulfillment/'.TestResource::TEST_API_VERSION.'/packages/'.$package_id);
    }

    public function testBatchShipPackages()
    {
        $this->caller->batchShipPackages([]);
        $this->assertPreviousRequest('POST', 'fulfillment/'.TestResource::TEST_API_VERSION.'/packages/ship');
    }

    public function testSplitOrders()
    {
        $order_id = 10002;
        $this->caller->splitOrders($order_id, []);
        $this->assertPreviousRequest('POST', 'fulfillment/'.TestResource::TEST_API_VERSION.'/orders/'.$order_id.'/split');
    }

    public function testCreatePackages()
    {
        $this->caller->createPackages(1000);
        $this->assertPreviousRequest('POST', 'fulfillment/'.TestResource::TEST_API_VERSION.'/packages');
    }

    public function testShipPackage()
    {
        $package_id = 300001;
        $this->caller->shipPackage($package_id);
        $this->assertPreviousRequest('POST', 'fulfillment/'.TestResource::TEST_API_VERSION.'/packages/'.$package_id.'/ship');
    }

    public function testUpdatePackageShippingInfo()
    {
        $package_id = 300001;
        $this->caller->updatePackageShippingInfo($package_id, 'tracking number', 200001);
        $this->assertPreviousRequest('POST', 'fulfillment/'.TestResource::TEST_API_VERSION.'/packages/'.$package_id.'/shipping_info/update');
    }

    public function testFulfillmentUploadDeliveryImage()
    {
        $this->caller->fulfillmentUploadDeliveryImage('php://memory');
        $this->assertPreviousRequest('POST', 'fulfillment/'.TestResource::TEST_API_VERSION.'/images/upload');
    }

    public function testGetEligibleShippingService()
    {
        $order_id = 100005;
        $this->caller->getEligibleShippingService($order_id);
        $this->assertPreviousRequest('POST', 'fulfillment/'.TestResource::TEST_API_VERSION.'/orders/'.$order_id.'/shipping_services/query');
    }
}
