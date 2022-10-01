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

class ReverseTest extends TestResource
{

    public function testConfirmReverseRequest()
    {
        $this->caller->confirmReverseRequest(1);
        $this->assertPreviousRequest('POST', 'reverse/reverse_request/confirm');
    }

    public function testRejectReverseRequest()
    {
        $this->caller->rejectReverseRequest(1, 'reverse_reject_request_reason_1');
        $this->assertPreviousRequest('POST','reverse/reverse_request/reject');
    }

    public function testGetReverseOrderList()
    {
        $this->caller->getReverseOrderList();
        $this->assertPreviousRequest('POST','reverse/reverse_order/list');
    }

    public function testGetRejectReasonList()
    {
        $this->caller->getRejectReasonList();
        $this->assertPreviousRequest('GET','reverse/reverse_reason/list');
    }

    public function testCancelOrder()
    {
        $this->caller->cancelOrder(1, 'cancel_reason');
        $this->assertPreviousRequest('POST','reverse/order/cancel');
    }
}
