<?php
/*
 * This file is part of tiktokshop-client.
 *
 * Copyright (c) 2023 Jin <j@sax.vn> All rights reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NVuln\TiktokShop\Tests\Resources;

use NVuln\TiktokShop\Resources\Event;
use NVuln\TiktokShop\Tests\TestResource;
use PHPUnit\Framework\TestCase;

/**
 * @property-read \NVuln\TiktokShop\Resources\Event $caller
 */
class EventTest extends TestResource
{

    public function testUpdateShopWebhook()
    {
        $this->caller->updateShopWebhook('ORDER_STATUS_CHANGE', 'https://example.com');
        $this->assertPreviousRequest('PUT', 'event/'.TestResource::TEST_API_VERSION.'/webhooks');
    }

    public function testGetShopWebhooks()
    {
        $this->caller->getShopWebhooks();
        $this->assertPreviousRequest('GET', 'event/'.TestResource::TEST_API_VERSION.'/webhooks');
    }

    public function testDeleteShopWebhook()
    {
        $this->caller->deleteShopWebhook('order_fulfillment');
        $this->assertPreviousRequest('DELETE', 'event/'.TestResource::TEST_API_VERSION.'/webhooks');
    }
}
