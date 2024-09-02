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
 * @property-read \EcomPHP\TiktokShop\Resources\Promotion $caller
 */
class PromotionTest extends TestResource
{

    public function testSearchActivities()
    {
        $this->caller->searchActivities();
        $this->assertPreviousRequest('POST', 'promotion/'.TestResource::TEST_API_VERSION.'/activities/search');
    }

    public function testGetActivity()
    {
        $activity_id = 1009;
        $this->caller->getActivity($activity_id);
        $this->assertPreviousRequest('GET', 'promotion/'.TestResource::TEST_API_VERSION.'/activities/'.$activity_id);
    }

    public function testUpdateActivity()
    {
        $activity_id = 1009;
        $this->caller->updateActivity($activity_id, 'test title', 'begin time', 'end time');
        $this->assertPreviousRequest('PUT', 'promotion/'.TestResource::TEST_API_VERSION.'/activities/'.$activity_id);
    }

    public function testDeactivateActivity()
    {
        $activity_id = 1009;
        $this->caller->deactivateActivity($activity_id);
        $this->assertPreviousRequest('POST', 'promotion/'.TestResource::TEST_API_VERSION.'/activities/'.$activity_id.'/deactivate');
    }

    public function testUpdateActivityProduct()
    {
        $activity_id = 1009;
        $this->caller->updateActivityProduct($activity_id, []);
        $this->assertPreviousRequest('PUT', 'promotion/'.TestResource::TEST_API_VERSION.'/activities/'.$activity_id.'/products');
    }

    public function testCreateActivity()
    {
        $this->caller->createActivity('test title', 'test type', 'begin time', 'end time', 'product level');
        $this->assertPreviousRequest('POST', 'promotion/'.TestResource::TEST_API_VERSION.'/activities');
    }

    public function testRemoveActivityProduct()
    {
        $activity_id = 1009;
        $this->caller->removeActivityProduct($activity_id);
        $this->assertPreviousRequest('DELETE', 'promotion/'.TestResource::TEST_API_VERSION.'/activities/'.$activity_id.'/products');
    }

    public function testSearchCoupons()
    {
        $this->caller->searchCoupons();
        $this->assertPreviousRequest('POST', 'promotion/'.TestResource::TEST_API_VERSION.'/coupons/search');
    }

    public function testGetCoupon()
    {
        $coupon_id = 1009;
        $this->caller->getCoupon($coupon_id);
        $this->assertPreviousRequest('GET', 'promotion/'.TestResource::TEST_API_VERSION.'/coupons/'.$coupon_id);
    }
}
