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
    protected $prefix = 'products';

    public function uploadFile($file, $file_name = 'uploaded_file')
    {
        if ($file instanceof SplFileInfo) {
            $file_name = $file->getFilename();
        }

        return $this->call('POST', 'upload_files', [
            RequestOptions::JSON => [
                'file_name' => $file_name,
                'file_data' => static::dataTypeCast('file', $file),
            ]
        ]);
    }

    public function uploadImage($image, $scene = 1 /* PRODUCT_IMAGE */)
    {
        return $this->call('POST', 'upload_imgs', [
            RequestOptions::JSON => [
                'img_data' => static::dataTypeCast('image', $image),
                'img_scene' => $scene,
            ]
        ]);
    }

    public function createProduct($data = [])
    {
        return $this->call('POST', '', [
            RequestOptions::JSON => $data
        ]);
    }

    public function deleteProduct($product_ids = [])
    {
        return $this->call('DELETE', '/', [
            RequestOptions::JSON => [
                'product_ids' => static::dataTypeCast('array', $product_ids)
            ]
        ]);
    }

    public function editProduct($product_id, $data = [])
    {
        $data['product_id'] = $product_id;

        return $this->call('PUT', '/', [
            RequestOptions::JSON => $data
        ]);
    }

    public function updateStock($product_id, $skus = [])
    {
        $data = [
            'product_id' => $product_id,
            'skus' => $skus
        ];

        return $this->call('PUT', 'stocks', [
            RequestOptions::JSON => $data
        ]);
    }

    public function getProductList($params = [])
    {
        $params = array_merge([
            'page_number' => 1,
            'page_size' => 20,
        ], $params);

        return $this->call('POST', 'search', [
            RequestOptions::JSON => $params
        ]);
    }

    public function getProductDetail($product_id, $need_audit_version = false)
    {
        return $this->call('GET', 'details', [
            RequestOptions::QUERY => [
                'product_id' => $product_id,
                'need_audit_version' => static::dataTypeCast('bool', $need_audit_version),
            ],
        ]);
    }

    public function deactivateProduct($product_ids = [])
    {
        return $this->call('POST', 'inactivated_products', [
            RequestOptions::JSON => [
                'product_ids' => static::dataTypeCast('array', $product_ids),
            ]
        ]);
    }

    public function activateProduct($product_ids = [])
    {
        return $this->call('POST', 'activate', [
            RequestOptions::JSON => [
                'product_ids' => static::dataTypeCast('array', $product_ids),
            ]
        ]);
    }

    public function recoverDeletedProduct($product_ids = [])
    {
        return $this->call('POST', 'recover', [
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

        return $this->call('PUT', 'prices', [
            RequestOptions::JSON => $data
        ]);
    }

    public function getCategories()
    {
        return $this->call('GET', 'categories');
    }

    public function getBrands($category_id = null)
    {
        $params = [];
        if ($category_id) {
            $params['category_id'] = $category_id;
        }

        return $this->call('GET', 'brands', [
            RequestOptions::QUERY => $params
        ]);
    }

    public function getAttributes($category_id)
    {
        return $this->call('GET', 'attributes', [
            RequestOptions::QUERY => [
                'category_id' => static::dataTypeCast('string', $category_id),
            ]
        ]);
    }

    public function getCategoryRule($category_id)
    {
        return $this->call('GET', 'categories/rules', [
            RequestOptions::QUERY => [
                'category_id' => $category_id
            ]
        ]);
    }
}
