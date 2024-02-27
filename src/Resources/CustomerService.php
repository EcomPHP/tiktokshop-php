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

class CustomerService extends Resource
{
    protected $category = 'customer_service';

    public function getConversationMessages($conversation_id, $params = [])
    {
        $params = array_merge([
            'page_size' => 20,
        ], $params);

        return $this->call('GET', 'conversations/'.$conversation_id.'/messages', [
            RequestOptions::QUERY => $params,
        ]);
    }

    public function getConversations($params = [])
    {
        $params = array_merge([
            'page_size' => 20,
        ], $params);

        return $this->call('GET', 'conversations', [
            RequestOptions::QUERY => $params,
        ]);
    }

    public function sendMessage($conversation_id, $type, $content)
    {
        return $this->call('POST', 'conversations/'.$conversation_id.'/messages', [
            RequestOptions::JSON => [
                'type' => $type,
                'content' => is_array($content) ? json_encode($content) : $content,
            ]
        ]);
    }

    public function getAgentSettings()
    {
        return $this->call('GET', 'agents/settings');
    }

    public function updateAgentSettings($body = [])
    {
        return $this->call('PUT', 'agents/settings', [
            RequestOptions::JSON => $body,
        ]);
    }

    public function uploadBuyerMessagesImage($image)
    {
        return $this->call('POST', 'images/upload', [
            RequestOptions::MULTIPART => [
                [
                    'name' => 'data',
                    'filename' => 'image',
                    'contents' => static::dataTypeCast('image', $image),
                ]
            ]
        ]);
    }

    public function readMessage($conversation_id)
    {
        return $this->call('POST', 'conversations/'.$conversation_id.'/messages/read');
    }

    public function createConversation($buyer_user_id)
    {
        return $this->call('POST', 'conversations', [
            RequestOptions::JSON => [
                'buyer_user_id' => $buyer_user_id,
            ]
        ]);
    }
}
