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

class ShopTest extends TestResource
{

    public function testGetAuthorizedShop()
    {
        $this->caller->getAuthorizedShop();
        $this->assertPreviousRequest('GET', 'shop/get_authorized_shop');
    }
}
