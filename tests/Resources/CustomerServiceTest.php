<?php
/*
 * This file is part of tiktokshop-client.
 *
 * Copyright (c) 2024 Jin <j@sax.vn> All rights reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EcomPHP\TiktokShop\Tests\Resources;

use EcomPHP\TiktokShop\Resources\CustomerService;
use EcomPHP\TiktokShop\Tests\TestResource;

class CustomerServiceTest extends TestResource
{
    public function testGetConversationMessages()
    {
        $this->caller->getConversationMessages('conversation_id');
        $this->assertPreviousRequest('GET', 'customer_service/'.TestResource::TEST_API_VERSION.'/conversations/conversation_id/messages');
    }

    public function testGetConversations()
    {
        $this->caller->getConversations();
        $this->assertPreviousRequest('GET', 'customer_service/'.TestResource::TEST_API_VERSION.'/conversations');
    }

    public function testSendMessage()
    {
        $this->caller->sendMessage('conversation_id', 'type', 'content');
        $this->assertPreviousRequest('POST', 'customer_service/'.TestResource::TEST_API_VERSION.'/conversations/conversation_id/messages');
    }

    public function testGetAgentSettings()
    {
        $this->caller->getAgentSettings();
        $this->assertPreviousRequest('GET', 'customer_service/'.TestResource::TEST_API_VERSION.'/agents/settings');
    }

    public function testUpdateAgentSettings()
    {
        $this->caller->updateAgentSettings();
        $this->assertPreviousRequest('PUT', 'customer_service/'.TestResource::TEST_API_VERSION.'/agents/settings');
    }

    public function testUploadBuyerMessagesImage()
    {
        $this->caller->uploadBuyerMessagesImage('php://memory');
        $this->assertPreviousRequest('POST', 'customer_service/'.TestResource::TEST_API_VERSION.'/images/upload');
    }

    public function testReadMessage()
    {
        $this->caller->readMessage('conversation_id');
        $this->assertPreviousRequest('POST', 'customer_service/'.TestResource::TEST_API_VERSION.'/conversations/conversation_id/messages/read');
    }

    public function testCreateConversation()
    {
        $this->caller->createConversation('buyer_id');
        $this->assertPreviousRequest('POST', 'customer_service/'.TestResource::TEST_API_VERSION.'/conversations');
    }
}
