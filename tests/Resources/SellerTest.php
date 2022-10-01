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

class SellerTest extends TestResource
{

    public function testGetActiveShopList()
    {
        $this->caller->getActiveShopList();
        $this->assertPreviousRequest('GET', 'seller/global/active_shops');
    }

    public function testCheckGlobalProductMode()
    {
        $this->caller->checkGlobalProductMode();
        $this->assertPreviousRequest('GET', 'seller/manage_global_product/check');
    }
}
