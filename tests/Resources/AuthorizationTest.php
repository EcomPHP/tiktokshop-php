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

class AuthorizationTest extends TestResource
{

    public function testGetAuthorizedShop()
    {
        $this->caller->getAuthorizedShop();
        $this->assertPreviousRequest('GET', 'authorization/'.TestResource::TEST_API_VERSION.'/shops');
    }
}
