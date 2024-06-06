<?php
/*
 * This file is part of tiktokshop-client.
 *
 * Copyright (c) 2024 Jin <j@sax.vn> All rights reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EcomPHP\TiktokShop\Resources;

use EcomPHP\TiktokShop\Resource;
use GuzzleHttp\RequestOptions;

class AffiliateSeller extends Resource
{
    protected $category = 'affiliate_seller';
    protected $minimum_version = 202405;

    public function editOpenCollaborationSettings($body)
    {
        return $this->call('POST', 'open_collaboration_settings', [
            RequestOptions::JSON => $body,
        ]);
    }
}
