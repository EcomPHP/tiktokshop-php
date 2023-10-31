<?php
/*
 * This file is part of tiktokshop-client.
 *
 * Copyright (c) 2023 Jin <j@sax.vn> All rights reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EcomPHP\TiktokShop\Tests\Resources;

use EcomPHP\TiktokShop\Tests\TestResource;

/**
 * @property-read \EcomPHP\TiktokShop\Resources\Finance $caller
 */
class FinanceTest extends TestResource
{

    public function testGetPayments()
    {
        $this->caller->getPayments();
        $this->assertPreviousRequest('GET', 'finance/'.TestResource::TEST_API_VERSION.'/payments');
    }

    public function testGetOrderStatementTransactions()
    {
        $order_id = 200001;
        $this->caller->getOrderStatementTransactions($order_id);
        $this->assertPreviousRequest('GET', 'finance/'.TestResource::TEST_API_VERSION.'/orders/'.$order_id.'/statement_transactions');
    }

    public function testGetStatementTransactions()
    {
        $statement_id = 200001;
        $this->caller->getStatementTransactions($statement_id);
        $this->assertPreviousRequest('GET', 'finance/'.TestResource::TEST_API_VERSION.'/statements/'.$statement_id.'/statement_transactions');
    }

    public function testGetStatements()
    {
        $this->caller->getStatements();
        $this->assertPreviousRequest('GET', 'finance/'.TestResource::TEST_API_VERSION.'/statements');
    }

    public function testGetWithdrawals()
    {
        $this->caller->getWithdrawals();
        $this->assertPreviousRequest('GET', 'finance/'.TestResource::TEST_API_VERSION.'/withdrawals');
    }
}
