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

class OrderTest extends TestResource
{
    public function testGetOrderDetail()
    {
        $this->caller->getOrderDetail('sample order id');
        $this->assertPreviousRequest('post', 'orders/detail/query');
    }

    public function testGetOrderList()
    {
        $this->caller->getOrderList();
        $this->assertPreviousRequest('post', 'orders/search');
    }
}
