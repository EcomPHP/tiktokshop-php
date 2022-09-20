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

use NVuln\TiktokShop\Tests\SDK;
use NVuln\TiktokShop\Tests\TestResource;

class OrderTest extends TestResource
{

    public function testGetOrderDetail()
    {
        $test_order_id = '576674884447668997';
        $order = SDK::$client->Order->getOrderDetail($test_order_id);

        $this->assertArrayHasKey('order_list', $order);
    }

    public function testGetOrderList()
    {
        $orders = SDK::$client->Order->getOrderList();

        $this->assertArrayHasKey('order_list', $orders);
        $this->assertArrayHasKey('total', $orders);
    }
}
