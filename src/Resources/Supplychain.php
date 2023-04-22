<?php
/*
 * This file is part of tiktokshop-client.
 *
 * (c) Jin <j@sax.vn>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NVuln\TiktokShop\Resources;

use GuzzleHttp\RequestOptions;
use NVuln\TiktokShop\Resource;

class Supplychain extends Resource
{
    public function packageFulfillmentDataSync($warehouse_provider_id, $package)
    {
        return $this->call('POST', 'supply_chain/package_shipment_confirmation', [
            RequestOptions::JSON => [
                'warehouse_provider_id' => $warehouse_provider_id,
                'package' => $package,
            ]
        ]);
    }
}
