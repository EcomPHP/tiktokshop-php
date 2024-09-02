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
 * @property-read \EcomPHP\TiktokShop\Resources\Authorization $caller
 */
class AuthorizationTest extends TestResource
{

    public function testGetAuthorizedShop()
    {
        $this->caller->getAuthorizedShop();
        $this->assertPreviousRequest('GET', 'authorization/'.TestResource::TEST_API_VERSION.'/shops');
    }

    public function testGetAuthorizedCategoryAssets()
    {
        $this->caller->getAuthorizedCategoryAssets();
        $this->assertPreviousRequest('GET', 'authorization/'.TestResource::TEST_API_VERSION.'/category_assets');
    }
}
