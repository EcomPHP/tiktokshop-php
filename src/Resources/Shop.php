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

class Shop extends Resource
{
    protected $prefix = 'shop';

    public function getAuthorizedShop()
    {
        return $this->call('GET', 'get_authorized_shop');
    }
}
