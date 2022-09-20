<?php
/*
 * This file is part of tiktok-shop.
 *
 * (c) Jin <j@sax.vn>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NVuln\TiktokShop\Resources;

use GuzzleHttp\RequestOptions;
use NVuln\TiktokShop\Resource;

class GlobalProduct extends Resource
{
    protected $prefix = 'product/global_products';

    public function createGlobalProduct($data = [])
    {
        return $this->call('POST', '/', [
            RequestOptions::JSON => $data,
        ]);
    }

    public function getGlobalProductList($params = [])
    {
        $params = array_merge([
            'page_size' => 20,
            'page_number' => 1,
        ], $params);

        return $this->call('POST', 'search', [
            RequestOptions::JSON => $params,
        ]);
    }

    public function getGlobalProductDetail($product_id)
    {
        return $this->call('GET', '/', [
            RequestOptions::QUERY => [
                'product_id' => $product_id,
            ]
        ]);
    }

    public function publishGlobalProduct($global_product_id, $publishable_shops)
    {
        return $this->call('POST', 'publish', [
            RequestOptions::JSON => [
                'global_product_id' => $global_product_id,
                'publishable_shops' => $publishable_shops,
            ]
        ]);
    }

    public function updateGlobalProductPrice($global_product_id, $skus)
    {
        return $this->call('PUT', 'prices', [
            RequestOptions::JSON => [
                'global_product_id' => $global_product_id,
                'skus' => $skus,
            ]
        ]);
    }

    public function getGlobalCategories()
    {
        return $this->call('GET', 'categories');
    }

    public function editGlobalProduct($global_product_id, $data = [])
    {
        $data['global_product_id'] = $global_product_id;

        return $this->call('PUT', '/', [
            RequestOptions::JSON => $data
        ]);
    }

    public function getGlobalAttributes($category_id)
    {
        return $this->call('GET', 'attributes', [
            RequestOptions::QUERY => [
                'category_id' => $category_id,
            ]
        ]);
    }

    public function getGlobalCategoryRule($category_id)
    {
        return $this->call('GET', 'categories/rules', [
            RequestOptions::QUERY => [
                'category_id' => $category_id,
            ]
        ]);
    }
}
