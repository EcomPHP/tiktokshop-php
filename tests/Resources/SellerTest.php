<?php
/*
 * This file is part of tiktokshop-client.
 *
 * (c) Jin <j@sax.vn>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EcomPHP\TiktokShop\Tests\Resources;

use EcomPHP\TiktokShop\Tests\TestResource;

/**
 * @property-read \EcomPHP\TiktokShop\Resources\Seller $caller
 */
class SellerTest extends TestResource
{

    public function testGetActiveShopList()
    {
        $this->caller->getActiveShopList();
        $this->assertPreviousRequest('GET', 'seller/'.TestResource::TEST_API_VERSION.'/shops');
    }

    public function testGetSellerPermissions()
    {
        $this->caller->getSellerPermissions();
        $this->assertPreviousRequest('GET', 'seller/'.TestResource::TEST_API_VERSION.'/permissions');
    }
}
