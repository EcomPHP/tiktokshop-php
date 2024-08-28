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

use EcomPHP\TiktokShop\Errors\TiktokShopException;
use EcomPHP\TiktokShop\Tests\TestResource;

/**
 * @property-read \EcomPHP\TiktokShop\Resources\AffiliateSeller $caller
 */
class AffiliateSellerTest extends TestResource
{
    public const TEST_API_VERSION = 202405;

    public function testEditOpenCollaborationSettings()
    {
        $this->caller->editOpenCollaborationSettings([]);
        $this->assertPreviousRequest('POST', 'affiliate_seller/'.self::TEST_API_VERSION.'/open_collaboration_settings');
    }

    public function testSearchOpenCollaborationProduct()
    {
        $this->caller->searchOpenCollaborationProduct();
        $this->assertPreviousRequest('POST', 'affiliate_seller/'.self::TEST_API_VERSION.'/open_collaborations/products/search');
    }

    public function testSearchSellerAffiliateOrders()
    {
        $this->caller->searchSellerAffiliateOrders();
        $this->assertPreviousRequest('POST', 'affiliate_seller/'.self::TEST_API_VERSION.'/orders/search');
    }

    public function testCreateOpenCollaboration()
    {
        $this->caller->createOpenCollaboration(1, 1);
        $this->assertPreviousRequest('POST', 'affiliate_seller/'.self::TEST_API_VERSION.'/open_collaborations');
    }

    public function testCreateTargetCollaboration()
    {
        $this->caller->createTargetCollaboration([]);
        $this->assertPreviousRequest('POST', 'affiliate_seller/'.self::TEST_API_VERSION.'/target_collaborations');
    }

    public function testRemoveCreatorAffiliateFromCollaboration()
    {
        $this->caller->removeCreatorAffiliateFromCollaboration(1, 2, 3);
        $this->assertPreviousRequest('POST', 'affiliate_seller/'.self::TEST_API_VERSION.'/open_collaborations/1/remove_creator');
    }

    public function testGetMarketplaceCreatorPerformance()
    {
        $this->caller->getMarketplaceCreatorPerformance(1);
        $this->assertPreviousRequest('GET', 'affiliate_seller/202406/marketplace_creators/1');
    }

    public function testSearchCreatorOnMarketplace()
    {
        $this->caller->searchCreatorOnMarketplace();
        $this->assertPreviousRequest('POST', 'affiliate_seller/202406/marketplace_creators/search');
    }
}
