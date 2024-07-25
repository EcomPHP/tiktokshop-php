<?php

namespace EcomPHP\TiktokShop\Tests\Resources;

use EcomPHP\TiktokShop\Tests\TestResource;

/**
 * @property-read \EcomPHP\TiktokShop\Resources\AffiliatePartner $caller
 */
class AffiliatePartnerTest extends TestResource
{
    public const TEST_API_VERSION = 202405;

    public function testCreateAffiliatePartnerCampaign()
    {
        $this->caller->createAffiliatePartnerCampaign([], []);
        $this->assertPreviousRequest('POST', 'affiliate_partner/'.self::TEST_API_VERSION.'/campaigns');
    }

    public function testGetAffiliatePartnerCampaignProductList()
    {
        $this->caller->getAffiliatePartnerCampaignProductList(1, []);
        $this->assertPreviousRequest('GET', 'affiliate_partner/'.self::TEST_API_VERSION.'/campaigns/1/products');
    }

    public function testGetAffiliatePartnerCampaignDetail()
    {
        $this->caller->getAffiliatePartnerCampaignDetail(1, []);
        $this->assertPreviousRequest('GET', 'affiliate_partner/'.self::TEST_API_VERSION.'/campaigns/1');
    }

    public function testReviewAffiliatePartnerCampaignProduct()
    {
        $this->caller->reviewAffiliatePartnerCampaignProduct(1, 2, [], []);
        $this->assertPreviousRequest('POST', 'affiliate_partner/'.self::TEST_API_VERSION.'/campaigns/1/products/2/review');
    }

    public function testEditAffiliatePartnerCampaign()
    {
        $this->caller->editAffiliatePartnerCampaign(1, [], []);
        $this->assertPreviousRequest('POST', 'affiliate_partner/'.self::TEST_API_VERSION.'/campaigns/1/partial_edit');
    }

    public function testGetAffiliatePartnerCampaignList()
    {
        $this->caller->getAffiliatePartnerCampaignList([]);
        $this->assertPreviousRequest('GET', 'affiliate_partner/'.self::TEST_API_VERSION.'/campaigns');
    }

    public function testPublishAffiliatePartnerCampaign()
    {
        $this->caller->publishAffiliatePartnerCampaign(1, []);
        $this->assertPreviousRequest('POST', 'affiliate_partner/'.self::TEST_API_VERSION.'/campaigns/1/publish');
    }

    public function testGenerateAffiliatePartnerCampaignProductLink()
    {
        $this->caller->generateAffiliatePartnerCampaignProductLink(1, 2, [], []);
        $this->assertPreviousRequest('POST', 'affiliate_partner/'.self::TEST_API_VERSION.'/campaigns/1/products/2/promotion_link/generate');
    }
}
