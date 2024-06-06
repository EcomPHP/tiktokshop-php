<?php
/*
 * This file is part of tiktokshop-client.
 *
 * Copyright (c) 2024 Jin <j@sax.vn> All rights reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EcomPHP\TiktokShop\Tests\Resources;

use EcomPHP\TiktokShop\Tests\TestResource;

class AffiliateSellerTest extends TestResource
{
    public const TEST_API_VERSION = 202405;

    protected function tiktokShopClientForTest()
    {
        $client = parent::tiktokShopClientForTest();
        $client->useVersion(self::TEST_API_VERSION);

        return $client;
    }

    public function testEditOpenCollaborationSettings()
    {
        $this->caller->editOpenCollaborationSettings([]);
        $this->assertPreviousRequest('POST', 'affiliate_seller/'.self::TEST_API_VERSION.'/open_collaboration_settings');
    }
}
