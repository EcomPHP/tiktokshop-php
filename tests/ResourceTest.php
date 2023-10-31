<?php
/*
 * This file is part of tiktokshop-client.
 *
 * (c) Jin <j@sax.vn>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EcomPHP\TiktokShop\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use EcomPHP\TiktokShop\Errors\ResponseException;
use EcomPHP\TiktokShop\Resource;
use PHPUnit\Framework\TestCase;

class ResourceTest extends TestCase
{
    protected $resource;

    protected function setUp(): void
    {
        parent::setUp();

        $this->resource = $this->getMockForAbstractClass(Resource::class);
    }

    public function testCall()
    {
        $client = new Client([
            'handler' => HandlerStack::create(new MockHandler([
                new Response(200, [], '{"code": 100000, "message": "error message", "request_id": "request id"}'),
            ]))
        ]);

        $this->resource->useHttpClient($client);

        $this->expectException(ResponseException::class);
        $this->resource->call('GET', 'http://fake_request.com');
    }

    public function testLastMessageAndRequestId()
    {
        $client = new Client([
            'handler' => HandlerStack::create(new MockHandler([
                new Response(200, [], '{"code": 0, "message": "error message", "request_id": "request id"}'),
            ]))
        ]);

        $this->resource->useHttpClient($client);
        $this->resource->call('GET', 'http://fake_request.com');

        $this->assertEquals($this->resource->getLastMessage(), 'error message');
        $this->assertEquals($this->resource->getLastRequestId(), 'request id');
    }
}
