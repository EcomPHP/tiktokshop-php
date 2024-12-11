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

use EcomPHP\TiktokShop\Resource;
use GuzzleHttp\RequestOptions;

class FulfilledByTiktok extends Resource
{
    protected $category = 'fbt';
    protected $minimum_version = 202408;

    public function getFbtMerchantOnboardedRegions()
    {
        return $this->call('GET', 'merchants/onboarded_regions', [], 202409);
    }

    public function getFbtWarehouseList()
    {
        return $this->call('GET', 'warehouses');
    }

    public function getInboundOrder($ids)
    {
        return $this->call('GET', 'inbound_orders', [
            RequestOptions::QUERY => [
                'ids' => static::dataTypeCast('array', $ids)
            ]
        ], 202409);
    }

    public function searchFbtInventory($query = [], $body = [])
    {
        $query = array_merge([
            'page_size' => 10,
        ], $query);

        return $this->call('POST', 'inventory/search', [
            RequestOptions::QUERY => $query,
            RequestOptions::JSON => $body,
        ]);
    }

    public function searchFbtInventoryRecord($query = [], $body = [])
    {
        $query = array_merge([
            'page_size' => 10,
        ], $query);

        return $this->call('POST', 'inventory_records/search', [
            RequestOptions::QUERY => $query,
            RequestOptions::JSON => $body,
        ], 202410);
    }

    public function searchGoodsInfo($query = [], $body = [])
    {
        $query = array_merge([
            'page_size' => 10,
        ], $query);

        return $this->call('POST', 'goods/search', [
            RequestOptions::QUERY => $query,
            RequestOptions::JSON => $body,
        ], 202409);
    }
}