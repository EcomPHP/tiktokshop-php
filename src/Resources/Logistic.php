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

class Logistic extends Resource
{
    protected $category = 'logistics';

    public function getWarehouseDeliveryOptions($warehouse_id)
    {
        return $this->call('GET', 'logistics/warehouses/'.$warehouse_id.'/delivery_options');
    }

    public function getShippingProvider($delivery_option_id)
    {
        return $this->call('GET','logistics/delivery_options/'.$delivery_option_id.'/shipping_providers');
    }

    public function getWarehouseList()
    {
        return $this->call('GET', 'logistics/get_warehouse_list');
    }

    public function getGlobalSellerWarehouse()
    {
        return $this->call('GET', 'logistics/global_warehouses');
    }
}
