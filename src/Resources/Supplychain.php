<?php
/*
 * This file is part of tiktokshop-client.
 *
 * (c) Jin <j@sax.vn>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EcomPHP\TiktokShop\Resources;

use GuzzleHttp\RequestOptions;
use EcomPHP\TiktokShop\Resource;

class Supplychain extends Resource
{
    protected $category = 'supply_chain';

    public function confirmPackageShipment($warehouse_provider_id, $package)
    {
        return $this->call('POST', 'packages/sync', [
            RequestOptions::JSON => [
                'warehouse_provider_id' => $warehouse_provider_id,
                'package' => $package,
            ]
        ]);
    }
}
