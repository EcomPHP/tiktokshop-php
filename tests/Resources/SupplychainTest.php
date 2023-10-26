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

use NVuln\TiktokShop\Tests\TestResource;

/**
 * @property-read \NVuln\TiktokShop\Resources\Supplychain $caller
 */
class SupplychainTest extends TestResource
{
    public function testConfirmPackageShipment()
    {
        $this->caller->confirmPackageShipment(1, []);
        $this->assertPreviousRequest('POST', 'supply_chain/'.TestResource::TEST_API_VERSION.'/packages/sync');
    }
}
