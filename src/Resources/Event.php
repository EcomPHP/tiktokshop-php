<?php
/*
 * This file is part of tiktokshop-client.
 *
 * Copyright (c) 2023 Jin <j@sax.vn> All rights reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EcomPHP\TiktokShop\Resources;

use EcomPHP\TiktokShop\Resource;
use GuzzleHttp\RequestOptions;

class Event extends Resource
{
    protected $category = 'event';

    public function getShopWebhooks()
    {
        return $this->call('GET', 'webhooks');
    }

    public function updateShopWebhook($event_type, $webhook_url)
    {
        return $this->call('PUT', 'webhooks', [
            RequestOptions::JSON => [
                'address' => $webhook_url,
                'event_type' => $event_type,
            ]
        ]);
    }

    public function deleteShopWebhook($event_type)
    {
        return $this->call('DELETE', 'webhooks', [
            RequestOptions::JSON => [
                'event_type' => $event_type,
            ]
        ]);
    }
}
