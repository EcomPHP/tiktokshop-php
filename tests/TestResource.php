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
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

use EcomPHP\TiktokShop\Client as TiktokApiClient;

abstract class TestResource extends TestCase
{
    public const TEST_API_VERSION = '202309';

    protected $caller;

    public static $container = [];

    protected function setUp(): void
    {
        parent::setUp();

        $resourceName = preg_replace('/.+\\\Resources\\\\(\w+)Test$/', '$1', get_called_class());

        $client = $this->tiktokShopClientForTest();

        $response = new Response(200, [], '{"code":0,"message":"success","data":[],"request_id":"sample request id"}');

        $mockHandler = new MockHandler();
        $mockHandler->append($response);

        $handler = HandlerStack::create($mockHandler);
        $handler->push(Middleware::history(static::$container));

        $httpClient = new Client([
            'handler' => $handler,
        ]);

        $this->caller = $client->{$resourceName};
        $this->caller->useVersion(static::TEST_API_VERSION);
        $this->caller->useHttpClient($httpClient);
    }

    protected function tiktokShopClientForTest()
    {
        $client = new TiktokApiClient('app_key', 'app_secret');
        $client->useVersion(static::TEST_API_VERSION);

        return $client;
    }

    protected function assertPreviousRequest($method, $uri)
    {
        $request = array_pop(static::$container)['request'];
        $this->assertEquals(strtolower($method), strtolower($request->getMethod()));
        $this->assertEquals($uri, trim($request->getUri()->getPath(), '/'));

        return $request;
    }
}
