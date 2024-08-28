<?php
/*
 * This file is part of tiktokshop-client.
 *
 * Copyright (c) 2024 Jin <j@sax.vn> All rights reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EcomPHP\TiktokShop\Resources;

use EcomPHP\TiktokShop\Resource;
use GuzzleHttp\RequestOptions;

class AffiliateSeller extends Resource
{
    protected $category = 'affiliate_seller';
    protected $minimum_version = 202405;

    public function editOpenCollaborationSettings($body)
    {
        return $this->call('POST', 'open_collaboration_settings', [
            RequestOptions::JSON => $body,
        ]);
    }

    public function searchOpenCollaborationProduct($query = [], $body = [])
    {
        $query = array_merge([
            'page_size' => 10,
        ], $query);

        return $this->call('POST', 'open_collaborations/products/search', [
            RequestOptions::QUERY => $query,
            RequestOptions::JSON => $body,
        ]);
    }

    public function searchSellerAffiliateOrders($query = [])
    {
        $query = array_merge([
            'page_size' => 10,
        ], $query);

        return $this->call('POST', 'orders/search', [
            RequestOptions::QUERY => $query,
            RequestOptions::JSON => [],
        ]);
    }

    public function createOpenCollaboration($product_id, $commission_rate, $require_seller_approve_creator = false)
    {
        return $this->call('POST', 'open_collaborations', [
            RequestOptions::JSON => [
                'product_id' => $product_id,
                'commission_rate' => $commission_rate,
                'require_seller_approve_creator' => $require_seller_approve_creator,
            ],
        ]);
    }

    public function createTargetCollaboration($body)
    {
        return $this->call('POST', 'target_collaborations', [
            RequestOptions::JSON => $body,
        ]);
    }

    public function removeCreatorAffiliateFromCollaboration($open_collaboration_id, $creator_user_id, $product_id)
    {
        return $this->call('POST', 'open_collaborations/'.$open_collaboration_id.'/remove_creator', [
            RequestOptions::JSON => [
                'creator_user_id' => $creator_user_id,
                'product_id' => $product_id,
            ],
        ]);
    }

    public function getMarketplaceCreatorPerformance($creator_user_id)
    {
        return $this->call('GET', 'marketplace_creators/'.$creator_user_id, [], 202406);
    }

    public function searchCreatorOnMarketplace($query = [], $body = [])
    {
        $query = array_merge([
            'page_size' => 12,
        ], $query);

        return $this->call('POST', 'marketplace_creators/search', [
            RequestOptions::QUERY => $query,
            RequestOptions::JSON => $body,
        ], 202406);
    }
}
