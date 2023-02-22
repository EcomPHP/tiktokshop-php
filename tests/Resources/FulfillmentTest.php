<?php
/*
 * This file is part of tiktokshop-client.
 *
 * (c) Jin <j@sax.vn>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NVuln\TiktokShop\Tests\Resources;

use NVuln\TiktokShop\Tests\TestResource;

class FulfillmentTest extends TestResource
{

    public function testConfirmOrderSplit()
    {
        $this->caller->confirmOrderSplit(1, []);
        $this->assertPreviousRequest('POST', 'fulfillment/order_split/confirm');
    }

    public function testSearchPackage()
    {
        $this->caller->searchPackage();
        $this->assertPreviousRequest('POST','fulfillment/search');
    }

    public function testUpdatePackageDeliveryStatus()
    {
        $this->caller->updatePackageDeliveryStatus();
        $this->assertPreviousRequest('POST', 'fulfillment/delivery');
    }

    public function testUpdatePackageShippingInfo()
    {
        $this->caller->updatePackageShippingInfo(1, 'tracking_number', 1);
        $this->assertPreviousRequest('POST', 'fulfillment/shipping_info/update');
    }

    public function testFulfillmentUploadFile()
    {
        $this->caller->fulfillmentUploadFile('file content');
        $this->assertPreviousRequest('POST', 'fulfillment/uploadfile');
    }

    public function testVerifyOrderSplit()
    {
        $this->caller->verifyOrderSplit(1);
        $this->assertPreviousRequest('POST', 'fulfillment/order_split/verify');
    }

    public function testSearchPreCombinePackage()
    {
        $this->caller->searchPreCombinePackage();
        $this->assertPreviousRequest('GET', 'fulfillment/pre_combine_pkg/list');
    }

    public function testGetPackageDetail()
    {
        $this->caller->getPackageDetail(1);
        $this->assertPreviousRequest('GET', 'fulfillment/detail');
    }

    public function testGetPackageShippingInfo()
    {
        $this->caller->getPackageShippingInfo(1);
        $this->assertPreviousRequest('GET', 'fulfillment/shipping_info');
    }

    public function testShipPackage()
    {
        $this->caller->shipPackage(1);
        $this->assertPreviousRequest('POST', 'fulfillment/rts');
    }

    public function testConfirmPrecombinePackage()
    {
        $this->caller->confirmPrecombinePackage(1);
        $this->assertPreviousRequest('POST', 'fulfillment/pre_combine_pkg/confirm');
    }

    public function testGetPackageShippingDocument()
    {
        $this->caller->getPackageShippingDocument(1, 1);
        $this->assertPreviousRequest('GET', 'fulfillment/shipping_document');
    }

    public function testGetPackagePickupConfig()
    {
        $this->caller->getPackagePickupConfig(1);
        $this->assertPreviousRequest('GET', 'fulfillment/package_pickup_config/list');
    }

    public function testRemovePackageOrder()
    {
        $this->caller->removePackageOrder(1);
        $this->assertPreviousRequest('POST', 'fulfillment/package/remove');
    }

    public function testFulfillmentUploadImage()
    {
        $this->caller->fulfillmentUploadImage('image content');
        $this->assertPreviousRequest('POST', 'fulfillment/uploadimage');
    }

    public function testBatchShipPackages()
    {
        $this->caller->batchShipPackages([]);
        $this->assertPreviousRequest('POST', 'fulfillment/batch_rts');
    }
}
