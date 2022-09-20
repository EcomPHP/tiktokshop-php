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

use NVuln\TiktokShop\Resource;

class Seller extends Resource
{
    protected $prefix = 'seller';

    public function getActiveShopList()
    {
        return $this->call('GET', 'global/active_shops');
    }

    public function checkGlobalProductMode()
    {
        return $this->call('GET', 'manage_global_product/check');
    }
}
