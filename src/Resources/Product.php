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
use SplFileInfo;

class Product extends Resource
{
    public function uploadFile($file, $file_name = 'uploaded_file')
    {
        if ($file instanceof SplFileInfo) {
            $file_name = $file->getFilename();
        }

        return $this->call('POST', 'products/upload_files', [
            RequestOptions::JSON => [
                'file_name' => $file_name,
                'file_data' => static::dataTypeCast('file', $file),
            ]
        ]);
    }

    public function uploadImage($image, $scene = 1 /* PRODUCT_IMAGE */)
    {
        return $this->call('POST', 'products/upload_imgs', [
            RequestOptions::JSON => [
                'img_data' => static::dataTypeCast('image', $image),
                'img_scene' => $scene,
            ]
        ]);
    }

    public function createProduct($data = [])
    {
        return $this->call('POST', 'products', [
            RequestOptions::JSON => $data
        ]);
    }

    public function createDraftProduct($data = [])
    {
        return $this->call('POST', 'products/save_draft', [
            RequestOptions::JSON => $data
        ]);
    }

    public function deleteProduct($product_ids = [])
    {
        return $this->call('DELETE', 'products', [
            RequestOptions::JSON => [
                'product_ids' => static::dataTypeCast('array', $product_ids)
            ]
        ]);
    }

    public function editProduct($product_id, $data = [])
    {
        $data['product_id'] = $product_id;

        return $this->call('PUT', 'products', [
            RequestOptions::JSON => $data
        ]);
    }

    public function updateStock($product_id, $skus = [])
    {
        $data = [
            'product_id' => $product_id,
            'skus' => $skus
        ];

        return $this->call('PUT', 'products/stocks', [
            RequestOptions::JSON => $data
        ]);
    }

    public function getProductList($params = [])
    {
        $params = array_merge([
            'page_number' => 1,
            'page_size' => 20,
        ], $params);

        return $this->call('POST', 'products/search', [
            RequestOptions::JSON => $params
        ]);
    }

    public function getProductDetail($product_id, $need_audit_version = false)
    {
        return $this->call('GET', 'products/details', [
            RequestOptions::QUERY => [
                'product_id' => $product_id,
                'need_audit_version' => static::dataTypeCast('bool', $need_audit_version),
            ],
        ]);
    }

    public function deactivateProduct($product_ids = [])
    {
        return $this->call('POST', 'products/inactivated_products', [
            RequestOptions::JSON => [
                'product_ids' => static::dataTypeCast('array', $product_ids),
            ]
        ]);
    }

    public function activateProduct($product_ids = [])
    {
        return $this->call('POST', 'products/activate', [
            RequestOptions::JSON => [
                'product_ids' => static::dataTypeCast('array', $product_ids),
            ]
        ]);
    }

    public function recoverDeletedProduct($product_ids = [])
    {
        return $this->call('POST', 'products/recover', [
            RequestOptions::JSON => [
                'product_ids' => static::dataTypeCast('array', $product_ids),
            ]
        ]);
    }

    public function updatePrice($product_id, $skus)
    {
        $data = [
            'product_id' => $product_id,
            'skus' => $skus
        ];

        return $this->call('PUT', 'products/prices', [
            RequestOptions::JSON => $data
        ]);
    }

    public function getCategories()
    {
        return $this->call('GET', 'products/categories');
    }

    public function getBrands(array $params)
    {
        return $this->call('GET', 'products/brands', [
            RequestOptions::QUERY => $params
        ]);
    }

    public function createBrand(string $brand_name)
    {
        return $this->call('POST', 'products/brand', [
            RequestOptions::JSON => [
                'brand_name' => $brand_name
            ]
        ]);
    }

    public function getAttributes($category_id)
    {
        return $this->call('GET', 'products/attributes', [
            RequestOptions::QUERY => [
                'category_id' => static::dataTypeCast('string', $category_id),
            ]
        ]);
    }

    public function getCategoryRule($category_id)
    {
        return $this->call('GET', 'products/categories/rules', [
            RequestOptions::QUERY => [
                'category_id' => $category_id
            ]
        ]);
    }

    public function categoryRecommended(string $product_name, string $description = '', array $images = [])
    {
        return $this->call('POST', 'product/category_recommend', [
            RequestOptions::QUERY => [
                'product_name' => $product_name,
                'description' => $description,
                'images' => $images,
            ]
        ]);
    }
}
