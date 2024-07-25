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
}
