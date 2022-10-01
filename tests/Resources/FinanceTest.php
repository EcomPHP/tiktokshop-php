<?php
/*
 * This file is part of tiktokshop-client.
 *
 * (c) Jin <j@sax.vn>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NVuln\TiktokShop\Tests\Resources;

use NVuln\TiktokShop\Tests\TestResource;

class FinanceTest extends TestResource
{
    public function testGetTransactions()
    {
        $this->caller->getTransactions();
        $this->assertPreviousRequest('POST', 'finance/transactions/search');
    }

    public function testGetOrderSettlements()
    {
        $this->caller->getOrderSettlements(1);
        $this->assertPreviousRequest('GET', 'finance/order/settlements');
    }

    public function testGetSettlements()
    {
        $this->caller->getSettlements();
        $this->assertPreviousRequest('POST', 'finance/settlements/search');
    }
}
