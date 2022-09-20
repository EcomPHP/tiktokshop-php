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

use NVuln\TiktokShop\Client;
use PHPUnit\Framework\TestCase;

abstract class TestResource extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        if (SDK::$client === null) {
            $client = new Client(getenv('TIKTOKSHOP_APP_KEY'), getenv('TIKTOKSHOP_APP_SECRET'));
            $client->useSandboxMode();
            $client->setShopId(getenv('TIKTOKSHOP_SHOP_ID'));

            $auth = $client->auth();
            $token = $auth->refreshNewToken(getenv('TIKTOKSHOP_REFRESH_TOKEN'));

            $client->setAccessToken($token['access_token']);
            SDK::$client = $client;
        }
    }

    public static function tearDownAfterClass(): void
    {
        SDK::$client = null;
    }
}
