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

class Logistic extends Resource
{
    protected $prefix = 'logistics';

    public function getSubscribedDeliveryOptions($warehouse_id_list = [])
    {
        return $this->call('POST', 'get_subscribed_deliveryoptions', [
            RequestOptions::JSON => [
                'warehouse_id_list' => static::dataTypeCast('array', $warehouse_id_list),
            ],
        ]);
    }

    public function updateShippingInfo($order_id, $tracking_number, $provider_id)
    {
        return $this->call('POST', 'tracking', [
            RequestOptions::JSON => [
                'order_id' => $order_id,
                'tracking_number' => $tracking_number,
                'provider_id' => $provider_id,
            ]
        ]);
    }

    public function getShippingDocument($order_id, $document_type, $document_size = 'A6')
    {
        return $this->call('GET', 'shipping_document', [
            RequestOptions::QUERY => [
                'order_id' => $order_id,
                'document_type' => $document_type,
                'document_size' => $document_size,
            ]
        ]);
    }

    public function getShippingProvider()
    {
        return $this->call('GET','shipping_providers');
    }

    public function getShippingInfo($order_id)
    {
        return $this->call('GET', 'ship/get', [
            RequestOptions::QUERY => [
                'order_id' => $order_id,
            ]
        ]);
    }

    public function getWarehouseList()
    {
        return $this->call('GET', 'get_warehouse_list');
    }
}
