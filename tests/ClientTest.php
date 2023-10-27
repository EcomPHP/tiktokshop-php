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

use GuzzleHttp\Psr7\Request;
use NVuln\TiktokShop\Auth;
use NVuln\TiktokShop\Client;
use NVuln\TiktokShop\Errors\TiktokShopException;
use NVuln\TiktokShop\Resource;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use ReflectionClass;

class ClientTest extends TestCase
{
    /**
     * @var Client
     */
    protected $client;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = new Client('app_key', 'app_secret');
    }

    public function testSetAccessToken()
    {
        $clientReflection = new ReflectionClass($this->client);

        $accessTokenProperty = $clientReflection->getProperty('access_token');
        $accessTokenProperty->setAccessible(true);

        $this->client->setAccessToken('new_access_token');
        $this->assertEquals('new_access_token', $accessTokenProperty->getValue($this->client));
    }

    public function testAuth()
    {
        $this->assertInstanceOf(Auth::class, $this->client->auth());
    }

    public function testUseSandboxMode()
    {
        $clientReflection = new ReflectionClass($this->client);
        $sandboxProperty = $clientReflection->getProperty('sandbox');
        $sandboxProperty->setAccessible(true);

        // sandbox is off
        $this->assertFalse($sandboxProperty->getValue($this->client));

        // change sandbox mode
        $this->client->useSandboxMode();
        $clientReflection = new ReflectionClass($this->client);
        $sandboxProperty = $clientReflection->getProperty('sandbox');
        $sandboxProperty->setAccessible(true);

        // sandbox is on
        $this->assertTrue($sandboxProperty->getValue($this->client));
    }

    public function test__get()
    {
        $resources = Client::resources;
        foreach ($resources as $resource) {
            $reflect = new ReflectionClass($resource);
            $className = $reflect->getShortName();

            $this->assertInstanceOf($resource, $this->client->{$className});
        }

        // test fail resource
        $this->expectException(TiktokShopException::class);
        $resource = $this->client->foo;
        $this->assertNotInstanceOf(Resource::class, $resource);
    }

    public function test__construct()
    {
        $clientReflection = new ReflectionClass($this->client);

        $this->assertEquals('app_key', $this->client->getAppKey());
        $this->assertEquals('app_secret', $this->client->getAppSecret());

        $sandboxProperty = $clientReflection->getProperty('sandbox');
        $sandboxProperty->setAccessible(true);

        $this->assertEquals(false, $sandboxProperty->getValue($this->client));
    }

    public function testPrepareSignature()
    {
        // create proxy class with public prepareSignature function
        $publicClient = new class('app_key', 'app_secret') extends Client {
            public function prepareSignature($request, &$params)
            {
                parent::prepareSignature($request, $params);
            }
        };

        $params = ['foo' => 'bar'];
        $publicClient->prepareSignature(new Request('GET', '/test-api'), $params);

        $this->assertArrayHasKey('sign', $params);
        $this->assertEquals('d3cb7fe11ecae942802ceeca67e7cf10120cc12f1517d45fbc1c8cfe5413c80f', $params['sign']);
    }

    public function testModifyRequestBeforeSend()
    {
        $request = new Request('GET', 'https://open-api.tiktokglobalshop.com/product/202309/products');

        $this->client->setAccessToken('access_token');
        $this->client->setShopCipher('shop_cipher');

        $clientReflection = new ReflectionClass($this->client);
        $modifyRequestMethod = $clientReflection->getMethod('modifyRequestBeforeSend');
        $modifyRequestMethod->setAccessible(true);

        $modifiedRequest = $modifyRequestMethod->invokeArgs($this->client, [$request]);
        $modifiedRequestUri = $modifiedRequest->getUri();
        parse_str($modifiedRequestUri->getQuery(), $query);

        $this->assertArrayHasKey('app_key', $query);
        $this->assertArrayHasKey('timestamp', $query);
        $this->assertArrayHasKey('sign', $query);
        $this->assertArrayHasKey('shop_cipher', $query);

        $this->assertArrayHasKey('x-tts-access-token', $modifiedRequest->getHeaders());
        $this->assertEquals('access_token', $modifiedRequest->getHeaderLine('x-tts-access-token'));

        // test for global product api
        $globalProductRequest = new Request('GET', 'https://open-api.tiktokglobalshop.com/product/202309/global_products/1231/inventory/update');
        $modifiedGlobalProductRequest = $modifyRequestMethod->invokeArgs($this->client, [$globalProductRequest]);
        $modifiedGlobalProductRequestUri = $modifiedGlobalProductRequest->getUri();
        parse_str($modifiedGlobalProductRequestUri->getQuery(), $globalProductQuery);

        $this->assertArrayNotHasKey('shop_cipher', $globalProductQuery);
    }
}
