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
use GuzzleHttp\Psr7\Response;
use NVuln\TiktokShop\Auth;
use NVuln\TiktokShop\Client as TiktokApiClient;
use NVuln\TiktokShop\Errors\AuthorizationException;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class AuthTest extends TestCase
{
    /**
     * @var \NVuln\TiktokShop\Client
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
        $reflect->getProperty('httpClient')->setValue($auth, $httpClient);

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
        $reflect->getProperty('httpClient')->setValue($auth, $httpClient);

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
        $this->assertMatchesRegularExpression($regex, $authUrl);
    }

    public function test__construct()
    {
        $client = new TiktokApiClient('app_key', 'app_secret');
        $auth = new Auth($client);

        $reflect = new ReflectionClass($auth);
        $this->assertEquals($client, $reflect->getProperty('client')->getValue($auth));
        $this->assertMatchesRegularExpression('/https:\/\/auth.tiktok-shops.com/i', $reflect->getProperty('authHost')->getValue($auth));
        $this->assertInstanceOf(Client::class, $reflect->getProperty('httpClient')->getValue($auth));
    }

}
