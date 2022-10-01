<?php
/*
 * This file is part of tiktokshop-client.
 *
 * (c) Jin <j@sax.vn>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NVuln\TiktokShop\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

use NVuln\TiktokShop\Client as TiktokApiClient;

abstract class TestResource extends TestCase
{
    protected $caller;

    /**
     * @var MockHandler
     */
    protected static $mockHandler;
    protected static $response;

    public static $httpClient;
    public static $container = [];

    protected function setUp(): void
    {
        parent::setUp();

        $reflection = new \ReflectionClass(static::class);
        $className = substr($reflection->getShortName(), 0, -4);

        $client = new TiktokApiClient('app_key', 'app_secret');

        $this->caller = $client->{$className};
        $this->caller->useHttpClient(static::$httpClient);
    }

    public static function setUpBeforeClass(): void
    {
        static::$response = new Response(200, [], '{"code":0,"message":"success","data":[],"request_id":"sample request id"}');
        static::$mockHandler = new MockHandler();
        static::$mockHandler->append(static::$response);

        $handler = HandlerStack::create(static::$mockHandler);
        $handler->push(Middleware::history(static::$container));

        static::$httpClient = new Client([
            'handler' => $handler,
        ]);
    }

    /**
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function getPreviousRequest()
    {
        $request = array_pop(static::$container)['request'];

        // reset mock queue and append response for next request
        static::$mockHandler->reset();
        static::$mockHandler->append(static::$response);

        return $request;
    }

    protected function assertPreviousRequest($method, $uri)
    {
        $request = $this->getPreviousRequest();
        $this->assertEquals(strtolower($method), strtolower($request->getMethod()));
        $this->assertEquals($uri, trim($request->getUri()->getPath(), '/'));
    }
}
