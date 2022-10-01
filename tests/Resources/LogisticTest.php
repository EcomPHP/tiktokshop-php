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

class LogisticTest extends TestResource
{

    public function testGetShippingInfo()
    {
        $this->caller->getShippingInfo(1);
        $this->assertPreviousRequest('GET', 'logistics/ship/get');
    }

    public function testGetWarehouseList()
    {
        $this->caller->getWarehouseList();
        $this->assertPreviousRequest('GET', 'logistics/get_warehouse_list');
    }

    public function testGetShippingProvider()
    {
        $this->caller->getShippingProvider();
        $this->assertPreviousRequest('GET', 'logistics/shipping_providers');
    }

    public function testGetSubscribedDeliveryOptions()
    {
        $this->caller->getSubscribedDeliveryOptions();
        $this->assertPreviousRequest('POST', 'logistics/get_subscribed_deliveryoptions');
    }

    public function testGetShippingDocument()
    {
        $this->caller->getShippingDocument(1, 'SHIPPING_LABEL');
        $this->assertPreviousRequest('GET', 'logistics/shipping_document');
    }

    public function testUpdateShippingInfo()
    {
        $this->caller->updateShippingInfo(1, 'tracking_number', 2);
        $this->assertPreviousRequest('POST', 'logistics/tracking');
    }
}
