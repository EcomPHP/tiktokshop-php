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
use EcomPHP\TiktokShop\Auth;
use EcomPHP\TiktokShop\Client as TiktokApiClient;
use EcomPHP\TiktokShop\Errors\AuthorizationException;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class AuthTest extends TestCase
{
    /**
     * @var \EcomPHP\TiktokShop\Client
     */
    protected $client;

    protected function setUp(): void
    {
        $this->client = new TiktokApiClient('app_key', 'app_secret');
    }

    public function testRefreshNewToken()
    {
        $mockHandler = new MockHandler([
            new Response(200, [], '{"code":0,"message":"success","data":[],"request_id":"sample request id"}'),
            new Response(200, [], '{"code":100,"message":"fail","data":[],"request_id":"sample request id"}'),
        ]);

        $httpClient = new Client([
            'handler' => HandlerStack::create($mockHandler)
        ]);

        $auth = $this->client->auth();

        $reflect = new ReflectionClass($auth);
        $httpClientProperty = $reflect->getProperty('httpClient');
        $httpClientProperty->setAccessible(true);
        $httpClientProperty->setValue($auth, $httpClient);

        $auth->refreshNewToken('refresh_token');
        $request = $mockHandler->getLastRequest();
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/v2/token/refresh', $request->getUri()->getPath());

        $this->expectException(AuthorizationException::class);
        $auth->refreshNewToken('failed refresh token');
    }

    public function testGetToken()
    {
        $mockHandler = new MockHandler([
            new Response(200, [], '{"code":0,"message":"success","data":[],"request_id":"sample request id"}'),
            new Response(200, [], '{"code":100,"message":"fail","data":[],"request_id":"sample request id"}'),
        ]);

        $httpClient = new Client([
            'handler' => HandlerStack::create($mockHandler)
        ]);

        $auth = $this->client->auth();

        $reflect = new ReflectionClass($auth);
        $httpClientProperty = $reflect->getProperty('httpClient');
        $httpClientProperty->setAccessible(true);
        $httpClientProperty->setValue($auth, $httpClient);

        $auth->getToken('auth code');
        $request = $mockHandler->getLastRequest();
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/v2/token/get', $request->getUri()->getPath());

        $this->expectException(AuthorizationException::class);
        $auth->getToken('failed auth code');
    }

    public function testCreateAuthRequest()
    {
        $client = new TiktokApiClient('app_key', 'app_secret');

        $auth = $client->auth();

        $regex = '/\/oauth\/authorize\?app_key=app_key&state=state$/i';

        // test returned url
        $authUrl = $auth->createAuthRequest('state', true);

        $this->assertEquals(true, !!preg_match($regex, $authUrl));
    }

    public function test__construct()
    {
        $client = new TiktokApiClient('app_key', 'app_secret');
        $auth = new Auth($client);

        $reflect = new ReflectionClass($auth);

        $clientProperty = $reflect->getProperty('client');
        $clientProperty->setAccessible(true);

        $authHostProperty = $reflect->getProperty('authHost');
        $authHostProperty->setAccessible(true);

        $httpClientProperty = $reflect->getProperty('httpClient');
        $httpClientProperty->setAccessible(true);

        $this->assertEquals($client, $clientProperty->getValue($auth));
        $this->assertEquals(true, !!preg_match('/https:\/\/auth.tiktok-shops.com/i', $authHostProperty->getValue($auth)));
        $this->assertInstanceOf(Client::class, $httpClientProperty->getValue($auth));
    }

}
