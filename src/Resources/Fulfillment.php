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
use SplFileInfo;

class Fulfillment extends Resource
{
    protected $category = 'fulfillment';

    public function searchCombinablePackages($query = [])
    {
        $query = array_merge([
            'page_size' => 20,
        ], $query);

        return $this->call('GET', 'combinable_packages/search', [
            RequestOptions::QUERY => $query
        ]);
    }

    public function getPackageShippingDocument($package_id, $document_type, $document_size = 0)
    {
        return $this->call('GET', 'packages/'.$package_id.'/shipping_documents', [
            RequestOptions::QUERY => [
                'document_type' => $document_type,
                'document_size' => $document_size,
            ]
        ]);
    }

    public function getPackageHandoverTimeSlots($package_id)
    {
        return $this->call('GET', 'packages/'.$package_id.'/handover_time_slots');
    }

    public function getTracking($order_id)
    {
        return $this->call('GET', 'orders/'.$order_id.'/tracking');
    }

    public function updatePackageShippingInfo($package_id, $tracking_number, $shipping_provider_id)
    {
        return $this->call('POST', 'packages/'.$package_id.'/shipping_info/update', [
            RequestOptions::JSON => [
                'tracking_number' => $tracking_number,
                'shipping_provider_id' => $shipping_provider_id,
            ]
        ]);
    }

    public function searchPackage($query = [], $params = [])
    {
        $query = array_merge([
            'page_size' => 20,
        ], $query);

        return $this->call('POST', 'packages/search', [
            RequestOptions::QUERY => $query,
            RequestOptions::JSON => $params,
        ]);
    }

    public function shipPackage($package_id, $handover_method = 'PICKUP', $pickup_slot = [], $self_shipment = [])
    {
        return $this->call('POST', 'packages/'.$package_id.'/ship', [
            RequestOptions::JSON => [
                'handover_method' => $handover_method,
                'pickup_slot' => $pickup_slot,
                'self_shipment' => $self_shipment,
            ]
        ]);
    }

    public function getPackageDetail($package_id)
    {
        return $this->call('GET', 'packages/'.$package_id);
    }

    public function fulfillmentUploadDeliveryImage($image)
    {
        return $this->call('POST', 'images/upload', [
            RequestOptions::MULTIPART => [
                [
                    'name' => 'data',
                    'filename' => 'image',
                    'contents' => static::dataTypeCast('image', $image),
                ],
            ],
        ]);
    }

    public function fulfillmentUploadDeliveryFile($file, $file_name = 'uploaded_file.pdf')
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

    public function updatePackageDeliveryStatus($packages = [])
    {
        return $this->call('POST', 'packages/deliver', [
            RequestOptions::JSON => [
                'packages' => $packages,
            ],
        ]);
    }

    public function batchShipPackages($packages)
    {
        return $this->call('POST', 'packages/ship', [
            RequestOptions::JSON => [
                'packages' => $packages,
            ],
        ]);
    }

    public function getOrderSplitAttributes($order_ids)
    {
        return $this->call('GET', 'orders/split_attributes', [
            RequestOptions::QUERY => [
                'order_ids' => static::dataTypeCast('array', $order_ids),
            ],
        ]);
    }

    public function splitOrders($order_id, $splittable_groups)
    {
        return $this->call('POST', 'orders/'.$order_id.'/split', [
            RequestOptions::JSON => [
                'order_id' => $order_id,
                'splittable_groups' => $splittable_groups,
            ],
        ]);
    }

    public function combinePackage($combinable_packages)
    {
        return $this->call('POST', 'packages/combine', [
            RequestOptions::JSON => [
                'combinable_packages' => $combinable_packages,
            ],
        ]);
    }

    public function uncombinePackages($package_id, $order_ids = [])
    {
        return $this->call('POST', 'packages/'.$package_id.'/uncombine', [
            RequestOptions::JSON => [
                'order_ids' => $order_ids,
            ],
        ]);
    }

    public function markPackageAsShipped($order_id, $tracking_number, $shipping_provider_id, $order_line_item_ids = [])
    {
        return $this->call('POST', 'orders/'.$order_id.'/packages', [
            RequestOptions::JSON => [
                'tracking_number' => $tracking_number,
                'shipping_provider_id' => $shipping_provider_id,
                'order_line_item_ids' => $order_line_item_ids,
            ],
        ]);
    }

    public function getEligibleShippingService($order_id, $params = [])
    {
        return $this->call('POST', 'orders/'.$order_id.'/shipping_services/query', [
            RequestOptions::JSON => $params,
        ]);
    }

    public function createPackages($order_id, $params = [])
    {
        $params['order_id'] = $order_id;

        return $this->call('POST', 'packages', [
            RequestOptions::JSON => $params,
        ]);
    }

    public function updateShippingInfo($order_id, $tracking_number, $shipping_provider_id)
    {
        return $this->call('POST', 'orders/'.$order_id.'/shipping_info/update', [
            RequestOptions::JSON => [
                'tracking_number' => $tracking_number,
                'shipping_provider_id' => $shipping_provider_id,
            ],
        ]);
    }
}
