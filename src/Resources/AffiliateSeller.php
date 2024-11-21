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

    public function generateAffiliateProductPromotionLink($product_id)
    {
        return $this->call('POST', 'products/'.$product_id.'/promotion_link/generate');
    }

    public function searchSampleApplicationsFulfillments($application_id, $body = [])
    {
        return $this->call('POST', 'sample_applications/'.$application_id.'/fulfillments/search', [
            RequestOptions::JSON => $body,
        ], 202409);
    }

    public function reviewSampleApplications($application_id, $review_result, $reject_reason = '')
    {
        return $this->call('POST', 'sample_applications/'.$application_id.'/review', [
            RequestOptions::JSON => [
                'review_result' => $review_result,
                'reject_reason' => $reject_reason,
            ],
        ], 202409);
    }

    public function getOpenCollaborationSampleRules($product_ids)
    {
        return $this->call('GET', 'open_collaborations/sample_rules', [
            RequestOptions::QUERY => [
                'product_ids' => static::dataTypeCast('array', $product_ids),
            ],
        ], 202410);
    }

    public function searchSampleApplications($query = [], $body = [])
    {
        $query = array_merge([
            'page_size' => 20,
        ], $query);

        return $this->call('POST', 'sample_applications/search', [
            RequestOptions::QUERY => $query,
            RequestOptions::JSON => $body,
        ], 202409);
    }

    public function editOpenCollaborationSampleRule($body = [])
    {
        return $this->call('POST', 'open_collaborations/sample_rules', [
            RequestOptions::JSON => $body,
        ], 202410);
    }

    public function removeTargetCollaboration($target_collaboration_id)
    {
        return $this->call('DELETE', 'target_collaborations/'.$target_collaboration_id,
            [], 202409);
    }

    public function queryTargetCollaborationDetail($target_collaboration_id)
    {
        return $this->call('GET', 'target_collaborations/'.$target_collaboration_id,
            [], 202409);
    }

    public function searchTargetCollaborations($query = [], $body = [])
    {
        $query = array_merge([
            'page_size' => 20,
        ], $query);

        return $this->call('POST', 'target_collaborations/search', [
            RequestOptions::QUERY => $query,
            RequestOptions::JSON => $body,
        ], 202409);
    }

    public function updateTargetCollaboration($target_collaboration_id, $body)
    {
        return $this->call('PUT', 'target_collaborations/'.$target_collaboration_id, [
            RequestOptions::JSON => $body,
        ], 202409);
    }

    public function searchOpenCollaboration($query = [], $body = [])
    {
        $query = array_merge([
            'page_size' => 20,
        ], $query);

        return $this->call('POST', 'open_collaborations/search', [
            RequestOptions::QUERY => $query,
            RequestOptions::JSON => $body,
        ], 202409);
    }

    public function getOpenCollaborationSettings()
    {
        return $this->call('GET', 'open_collaboration_settings', [], 202409);
    }

    public function removeOpenCollaboration($product_id)
    {
        return $this->call('DELETE', 'open_collaborations/products/'.$product_id, [], 202409);
    }
}
