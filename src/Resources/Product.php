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
use SplFileInfo;

/**
 * separate global product api to easier managed
 */
class Product extends GlobalProduct
{
    protected $category = 'product';

    public function uploadProductFile($file, $file_name = 'uploaded_file.pdf')
    {
        if ($file instanceof SplFileInfo) {
            $file_name = $file->getFilename();
        }

        return $this->call('POST', 'files/upload', [
            RequestOptions::MULTIPART => [
                [
                    'name' => 'data',
                    'filename' => $file_name,
                    'contents' => static::dataTypeCast('file', $file),
                ],
                [
                    'name' => 'name',
                    'contents' => $file_name,
                ]
            ]
        ]);
    }

    public function uploadProductImage($image, $use_case = 'MAIN_IMAGE')
    {
        return $this->call('POST', 'images/upload', [
            RequestOptions::MULTIPART => [
                [
                    'name' => 'data',
                    'filename' => 'image',
                    'contents' => static::dataTypeCast('image', $image),
                ],
                [
                    'name' => 'use_case',
                    'contents' => $use_case,
                ]
            ]
        ]);
    }

    public function createProduct($data)
    {
        return $this->call('POST', 'products', [
            RequestOptions::JSON => $data
        ]);
    }

    public function deleteProducts($product_ids = [])
    {
        return $this->call('DELETE', 'products', [
            RequestOptions::JSON => [
                'product_ids' => $product_ids,
            ]
        ]);
    }

    public function editProduct($product_id, $data = [])
    {
        return $this->call('PUT', 'products/'.$product_id, [
            RequestOptions::JSON => $data
        ]);
    }

    public function updateInventory($product_id, $params = [])
    {
        return $this->call('POST', 'products/'.$product_id.'/inventory/update', [
            RequestOptions::JSON => $params
        ]);
    }

    public function getProduct($product_id, $params = [])
    {
        return $this->call('GET', 'products/'.$product_id, [
            RequestOptions::QUERY => $params,
        ]);
    }

    public function deactivateProducts($product_ids = [])
    {
        return $this->call('POST', 'products/deactivate', [
            RequestOptions::JSON => [
                'product_ids' => $product_ids,
            ]
        ]);
    }

    public function activateProducts($product_ids = [])
    {
        return $this->call('POST', 'products/activate', [
            RequestOptions::JSON => [
                'product_ids' => $product_ids,
            ]
        ]);
    }

    public function recoverProducts($product_ids = [])
    {
        return $this->call('POST', 'products/recover', [
            RequestOptions::JSON => [
                'product_ids' => $product_ids,
            ]
        ]);
    }

    public function updatePrice($product_id, $params)
    {
        return $this->call('POST', 'products/'.$product_id.'/prices/update', [
            RequestOptions::JSON => $params
        ]);
    }

    public function getCategories($params = [])
    {
        return $this->call('GET', 'categories', [
            RequestOptions::QUERY => $params
        ]);
    }

    public function getBrands($query = [])
    {
        $query = array_merge([
            'page_size' => 20,
        ], $query);

        return $this->call('GET', 'brands', [
            RequestOptions::QUERY => $query
        ]);
    }

    public function createCustomBrand($name)
    {
        return $this->call('POST', 'brands', [
            RequestOptions::JSON => [
                'name' => $name
            ]
        ]);
    }

    public function getAttributes($category_id, $params = [])
    {
        return $this->call('GET', 'categories/'.$category_id.'/attributes', [
            RequestOptions::QUERY => $params
        ]);
    }

    public function getCategoryRules($category_id, $params = [])
    {
        return $this->call('GET', 'categories/'.$category_id.'/rules', [
            RequestOptions::QUERY => $params
        ]);
    }

    public function recommendCategory($product_title, $description = '', $images = [], $category_version = 'v1')
    {
        return $this->call('POST', 'categories/recommend', [
            RequestOptions::JSON => [
                'product_title' => $product_title,
                'description' => $description,
                'images' => $images,
                'category_version' => $category_version,
            ]
        ]);
    }

    public function checkListingPrerequisites()
    {
        return $this->call('GET', 'prerequisites');
    }

    public function partialEditProduct($product_id, $params = [])
    {
        return $this->call('POST', 'products/'.$product_id.'/partial_edit', [
            RequestOptions::JSON => $params
        ]);
    }

    public function searchProducts($query = [], $body = null)
    {
        if ($body === null) {
            static::extractParams($query, $query, $body);
        }

        return $this->call('POST', 'products/search', [
            RequestOptions::QUERY => $query,
            is_array($body) ? RequestOptions::JSON : RequestOptions::FORM_PARAMS => $body,
        ]);
    }

    public function inventorySearch($params = [])
    {
        return $this->call('POST', 'inventory/search', [
            RequestOptions::JSON => $params
        ]);
    }
}
