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

class AffiliateCreator extends Resource
{
    protected $category = 'affiliate_creator';
    protected $minimum_version = 202405;

    public function addShowcaseProducts($add_type, $product_ids = [], $product_link = '')
    {
        return $this->call('POST', 'showcases/products/add', [
            'add_type' => $add_type,
            'product_ids' => $product_ids,
            'product_link' => $product_link,
        ]);
    }

    public function getShowcaseProducts($query = [])
    {
        $query = array_merge([
            'page_size' => 10,
            'origin' => 'LIVE',
        ], $query);

        return $this->call('GET', 'showcases/products', [
            RequestOptions::QUERY => $query,
        ]);
    }

    public function getCreatorProfile()
    {
        return $this->call('GET', 'profiles');
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

    public function searchTargetCollaborations($query, $body = [])
    {
        $query = array_merge([
            'page_size' => 10,
        ], $query);

        return $this->call('POST', 'target_collaborations/search', [
            RequestOptions::QUERY => $query,
            RequestOptions::JSON => $body,
        ]);
    }

    public function searchAffiliateOrders($query = [])
    {
        $query = array_merge([
            'page_size' => 10,
        ], $query);

        return $this->call('POST', 'orders/search', [
            RequestOptions::QUERY => $query,
            RequestOptions::JSON => [],
        ]);
    }
}
