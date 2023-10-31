<?php
/*
 * This file is part of tiktok-shop.
 *
 * (c) Jin <j@sax.vn>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EcomPHP\TiktokShop\Resources;

use GuzzleHttp\RequestOptions;
use EcomPHP\TiktokShop\Resource;

class GlobalProduct extends Resource
{
    protected $category = 'product';

    public function createGlobalProduct($data)
    {
        return $this->call('POST', 'global_products', [
            RequestOptions::JSON => $data,
        ]);
    }

    public function getGlobalProduct($global_product_id)
    {
        return $this->call('GET', 'global_products/'.$global_product_id);
    }

    public function publishGlobalProduct($global_product_id, $params = [])
    {
        return $this->call('POST', 'global_products/'.$global_product_id.'/publish', [
            RequestOptions::JSON => $params
        ]);
    }

    public function getGlobalCategories($params = [])
    {
        return $this->call('GET', 'global_categories', [
            RequestOptions::QUERY => $params,
        ]);
    }

    public function editGlobalProduct($global_product_id, $data = [])
    {
        return $this->call('PUT', 'global_products/'.$global_product_id, [
            RequestOptions::JSON => $data
        ]);
    }

    public function getGlobalAttributes($category_id, $params = [])
    {
        return $this->call('GET', 'categories/'.$category_id.'/global_attributes', [
            RequestOptions::QUERY => $params
        ]);
    }

    public function getGlobalCategoryRules($category_id)
    {
        return $this->call('GET', 'categories/'.$category_id.'/global_rules');
    }

    public function recommendGlobalCategories($params = [])
    {
        return $this->call('POST', 'global_categories/recommend', [
            RequestOptions::JSON => $params
        ]);
    }

    public function updateGlobalInventory($global_product_id, $params = [])
    {
        return $this->call('POST', 'global_products/'.$global_product_id.'/inventory/update', [
            RequestOptions::JSON => $params
        ]);
    }

    public function searchGlobalProducts($params = [], $page_size = 20, $page_token = '')
    {
        return $this->call('POST', 'global_products/search', [
            RequestOptions::QUERY => [
                'page_size' => $page_size,
                'page_token' => $page_token,
            ],
            RequestOptions::JSON => $params
        ]);
    }

    public function deleteGlobalProducts($global_product_ids)
    {
        return $this->call('DELETE', 'global_products', [
            RequestOptions::JSON => [
                'global_product_ids' => $global_product_ids,
            ]
        ]);
    }
}
