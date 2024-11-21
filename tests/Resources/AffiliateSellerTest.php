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

    public function testGenerateAffiliateProductPromotionLink()
    {
        $this->caller->generateAffiliateProductPromotionLink(1);
        $this->assertPreviousRequest('POST', 'affiliate_seller/'.self::TEST_API_VERSION.'/products/1/promotion_link/generate');
    }

    public function testSearchSampleApplicationsFulfillments()
    {
        $this->caller->searchSampleApplicationsFulfillments(1);
        $this->assertPreviousRequest('POST', 'affiliate_seller/202409/sample_applications/1/fulfillments/search');
    }

    public function testReviewSampleApplications()
    {
        $this->caller->reviewSampleApplications(1, '', '');
        $this->assertPreviousRequest('POST', 'affiliate_seller/202409/sample_applications/1/review');
    }

    public function testGetOpenCollaborationSampleRules()
    {
        $this->caller->getOpenCollaborationSampleRules([]);
        $this->assertPreviousRequest('GET', 'affiliate_seller/202410/open_collaborations/sample_rules');
    }

    public function testSearchSampleApplications()
    {
        $this->caller->searchSampleApplications();
        $this->assertPreviousRequest('POST', 'affiliate_seller/202409/sample_applications/search');
    }

    public function testEditOpenCollaborationSampleRule()
    {
        $this->caller->editOpenCollaborationSampleRule([]);
        $this->assertPreviousRequest('POST', 'affiliate_seller/202410/open_collaborations/sample_rules');
    }

    public function testRemoveTargetCollaboration()
    {
        $this->caller->removeTargetCollaboration(1);
        $this->assertPreviousRequest('DELETE', 'affiliate_seller/202409/target_collaborations/1');
    }

    public function testQueryTargetCollaborationDetail()
    {
        $this->caller->queryTargetCollaborationDetail(1);
        $this->assertPreviousRequest('GET', 'affiliate_seller/202409/target_collaborations/1');
    }

    public function testSearchTargetCollaborations()
    {
        $this->caller->searchTargetCollaborations();
        $this->assertPreviousRequest('POST', 'affiliate_seller/202409/target_collaborations/search');
    }

    public function testUpdateTargetCollaboration()
    {
        $this->caller->updateTargetCollaboration(1, []);
        $this->assertPreviousRequest('PUT', 'affiliate_seller/202409/target_collaborations/1');
    }

    public function testSearchOpenCollaboration()
    {
        $this->caller->searchOpenCollaboration();
        $this->assertPreviousRequest('POST', 'affiliate_seller/202409/open_collaborations/search');
    }

    public function testGetOpenCollaborationSettings()
    {
        $this->caller->getOpenCollaborationSettings();
        $this->assertPreviousRequest('GET', 'affiliate_seller/202409/open_collaboration_settings');
    }

    public function testRemoveOpenCollaboration()
    {
        $this->caller->removeOpenCollaboration(1);
        $this->assertPreviousRequest('DELETE', 'affiliate_seller/202409/open_collaborations/products/1');
    }
}
