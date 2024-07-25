<?php
/*
 * This file is part of tiktokshop-php.
 *
 * Copyright (c) 2024 Jin <j@sax.vn> All rights reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EcomPHP\TiktokShop\Resources;

use EcomPHP\TiktokShop\Resource;
use GuzzleHttp\RequestOptions;

class AffiliatePartner extends Resource
{
    protected $category = 'affiliate_partner';
    protected $minimum_version = 202405;

    public function createAffiliatePartnerCampaign($query, $body)
    {
        return $this->call('POST', 'campaigns', [
            RequestOptions::QUERY => $query,
            RequestOptions::JSON => $body,
        ]);
    }

    public function getAffiliatePartnerCampaignProductList($campaign_id, $query)
    {
        return $this->call('GET', 'campaigns/'.$campaign_id.'/products', [
            RequestOptions::QUERY => $query,
        ]);
    }

    public function getAffiliatePartnerCampaignDetail($campaign_id, $query)
    {
        return $this->call('GET', 'campaigns/'.$campaign_id, [
            RequestOptions::QUERY => $query,
        ]);
    }

    public function reviewAffiliatePartnerCampaignProduct($campaign_id, $product_id, $query, $body)
    {
        return $this->call('POST', 'campaigns/'.$campaign_id.'/products/'.$product_id.'/review', [
            RequestOptions::QUERY => $query,
            RequestOptions::JSON => $body,
        ]);
    }

    public function editAffiliatePartnerCampaign($campaign_id, $query, $body)
    {
        return $this->call('POST', 'campaigns/'.$campaign_id.'/partial_edit', [
            RequestOptions::QUERY => $query,
            RequestOptions::JSON => $body,
        ]);
    }

    public function getAffiliatePartnerCampaignList($query)
    {
        return $this->call('GET', 'campaigns', [
            RequestOptions::QUERY => $query,
        ]);
    }

    public function publishAffiliatePartnerCampaign($campaign_id, $query)
    {
        return $this->call('POST', 'campaigns/'.$campaign_id.'/publish', [
            RequestOptions::QUERY => $query,
        ]);
    }

    public function generateAffiliatePartnerCampaignProductLink($campaign_id, $product_id, $query, $body)
    {
        return $this->call('POST', 'campaigns/'.$campaign_id.'/products/'.$product_id.'/promotion_link/generate', [
            RequestOptions::QUERY => $query,
            RequestOptions::JSON => $body,
        ]);
    }
}
