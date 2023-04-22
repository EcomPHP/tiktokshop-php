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

class Fulfillment extends Resource
{
    protected $prefix = 'fulfillment';

    /**
     * VerifyOrderSplit: Use this interface to verify if the order can be split
     */
    public function verifyOrderSplit($order_id_list = [])
    {
        return $this->call('POST', 'order_split/verify', [
            RequestOptions::JSON => [
                'order_id_list' => static::dataTypeCast('array', $order_id_list),
            ]
        ]);
    }

    /**
     * Confirm order split,use this API to split order.
     */
    public function confirmOrderSplit($order_id, $split_group)
    {
        return $this->call('POST', 'order_split/confirm', [
            RequestOptions::JSON => [
                'order_id' => $order_id,
                'split_group' => $split_group,
            ]
        ]);
    }

    /**
     * Get a list of all orders that can be "combined" by the current seller
     */
    public function searchPreCombinePackage($params = [])
    {
        $params = array_merge([
            'page_size' => 20,
        ], $params);

        return $this->call('GET', 'pre_combine_pkg/list', [
            RequestOptions::QUERY => $params
        ]);
    }

    public function getPackageShippingDocument($package_id, $document_type, $document_size = 0)
    {
        return $this->call('GET', 'shipping_document', [
            RequestOptions::QUERY => [
                'package_id' => $package_id,
                'document_type' => $document_type,
                'document_size' => $document_size,
            ]
        ]);
    }

    public function updatePackageShippingInfo($package_id, $tracking_number, $provider_id)
    {
        return $this->call('POST', 'shipping_info/update', [
            RequestOptions::JSON => [
                'package_id' => $package_id,
                'tracking_number' => $tracking_number,
                'provider_id' => $provider_id,
            ]
        ]);
    }

    public function getPackageShippingInfo($package_id)
    {
        return $this->call('GET', 'shipping_info', [
            RequestOptions::QUERY => [
                'package_id' => $package_id,
            ]
        ]);
    }

    public function searchPackage($params = [])
    {
        $params = array_merge([
            'page_size' => 20,
        ], $params);

        return $this->call('POST', 'search', [
            RequestOptions::JSON => $params,
        ]);
    }

    public function shipPackage($package_id, $pick_up_type = 1, $pick_up = [], $self_shipment = [])
    {
        return $this->call('POST', 'rts', [
            RequestOptions::JSON => [
                'package_id' => $package_id,
                'pick_up_type' => $pick_up_type,
                'pick_up' => $pick_up,
                'self_shipment' => $self_shipment,
            ]
        ]);
    }

    public function getPackagePickupConfig($package_id)
    {
        return $this->call('GET', 'package_pickup_config/list', [
            RequestOptions::QUERY => [
                'package_id' => $package_id,
            ]
        ]);
    }

    public function removePackageOrder($package_id, $order_id_list = [])
    {
        return $this->call('POST', 'package/remove', [
            RequestOptions::JSON => [
                'package_id' => $package_id,
                'order_id_list' => static::dataTypeCast('array', $order_id_list),
            ],
        ]);
    }

    public function confirmPrecombinePackage($pre_combine_pkg_list = [])
    {
        return $this->call('POST', 'pre_combine_pkg/confirm', [
            RequestOptions::JSON => [
                'pre_combine_pkg_list' => static::dataTypeCast('array', $pre_combine_pkg_list),
            ],
        ]);
    }

    public function getPackageDetail($package_id)
    {
        return $this->call('GET', 'detail', [
            RequestOptions::QUERY => [
                'package_id' => $package_id,
            ]
        ]);
    }

    public function fulfillmentUploadImage($image, $scene = 0 /* UNSPECIFIED */)
    {
        return $this->call('POST', 'uploadimage', [
            RequestOptions::JSON => [
                'img_data' => static::dataTypeCast('image', $image),
                'img_scene' => $scene,
            ]
        ]);
    }

    public function fulfillmentUploadFile($file, $file_name = 'uploaded_file')
    {
        if ($file instanceof SplFileInfo) {
            $file_name = $file->getFilename();
        }

        return $this->call('POST', 'uploadfile', [
            RequestOptions::JSON => [
                'file_name' => $file_name,
                'file_data' => static::dataTypeCast('file', $file),
            ]
        ]);
    }

    public function updatePackageDeliveryStatus($delivery_packages = [])
    {
        return $this->call('POST', 'delivery', [
            RequestOptions::JSON => [
                'delivery_packages' => $delivery_packages,
            ],
        ]);
    }

    /**
     * Use this api to batch ship packages
     */
    public function batchShipPackages($package_list)
    {
        return $this->call('POST', 'batch_rts', [
            RequestOptions::JSON => [
                'package_list' => static::dataTypeCast('array', $package_list),
            ],
        ]);
    }
}
