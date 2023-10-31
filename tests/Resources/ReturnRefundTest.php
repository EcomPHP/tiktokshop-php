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
 * @property-read \EcomPHP\TiktokShop\Resources\ReturnRefund $caller
 */
class ReturnRefundTest extends TestResource
{

    public function testRejectCancellation()
    {
        $this->caller->rejectCancellation(1009, []);
        $this->assertPreviousRequest('POST', 'return_refund/'.TestResource::TEST_API_VERSION.'/cancellations/1009/reject');
    }

    public function testCreateReturn()
    {
        $this->caller->createReturn([]);
        $this->assertPreviousRequest('POST', 'return_refund/'.TestResource::TEST_API_VERSION.'/returns');
    }

    public function testApproveCancellation()
    {
        $this->caller->approveCancellation(1009);
        $this->assertPreviousRequest('POST', 'return_refund/'.TestResource::TEST_API_VERSION.'/cancellations/1009/approve');
    }

    public function testGetRejectReasons()
    {
        $this->caller->getRejectReasons();
        $this->assertPreviousRequest('GET', 'return_refund/'.TestResource::TEST_API_VERSION.'/reject_reasons');
    }

    public function testCancelOrder()
    {
        $this->caller->cancelOrder([]);
        $this->assertPreviousRequest('POST', 'return_refund/'.TestResource::TEST_API_VERSION.'/cancellations');
    }

    public function testGetAftersaleEligibility()
    {
        $this->caller->getAftersaleEligibility(1009);
        $this->assertPreviousRequest('GET', 'return_refund/'.TestResource::TEST_API_VERSION.'/orders/1009/aftersale_eligibility');
    }

    public function testSearchReturns()
    {
        $this->caller->searchReturns();
        $this->assertPreviousRequest('POST', 'return_refund/'.TestResource::TEST_API_VERSION.'/returns/search');
    }

    public function testApproveReturn()
    {
        $this->caller->approveReturn(1009, []);
        $this->assertPreviousRequest('POST', 'return_refund/'.TestResource::TEST_API_VERSION.'/returns/1009/approve');
    }

    public function testRejectReturn()
    {
        $this->caller->rejectReturn(1009, []);
        $this->assertPreviousRequest('POST', 'return_refund/'.TestResource::TEST_API_VERSION.'/returns/1009/reject');
    }

    public function testSearchCancellations()
    {
        $this->caller->searchCancellations();
        $this->assertPreviousRequest('POST', 'return_refund/'.TestResource::TEST_API_VERSION.'/cancellations/search');
    }

    public function testCalculateRefund()
    {
        $this->caller->calculateRefund([]);
        $this->assertPreviousRequest('POST', 'return_refund/'.TestResource::TEST_API_VERSION.'/refunds/calculate');
    }

    public function testGetReturnRecords()
    {
        $this->caller->getReturnRecords(1009);
        $this->assertPreviousRequest('GET', 'return_refund/'.TestResource::TEST_API_VERSION.'/returns/1009/records');
    }
}
