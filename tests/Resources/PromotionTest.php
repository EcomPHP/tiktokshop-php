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

class PromotionTest extends TestResource
{

    public function testAddOrUpdateDiscountItem()
    {
        $this->caller->addOrUpdateDiscountItem('request serial no', 'id', []);
        $this->assertPreviousRequest('POST', 'promotion/activity/items/addorupdate');
    }

    public function testAddPromotion()
    {
        $this->caller->addPromotion('request serial no', 1, 'title');
        $this->assertPreviousRequest('POST', 'promotion/activity/create');
    }

    public function testGetPromotionList()
    {
        $this->caller->getPromotionList();
        $this->assertPreviousRequest('POST', 'promotion/activity/list');
    }

    public function testGetPromotionDetail()
    {
        $this->caller->getPromotionDetail(1);
        $this->assertPreviousRequest('GET', 'promotion/activity/get');
    }

    public function testUpdateBasicInformation()
    {
        $this->caller->updateBasicInformation('request serial no', 1, 'title');
        $this->assertPreviousRequest('POST', 'promotion/activity/update');
    }

    public function testDeactivatePromotion()
    {
        $this->caller->deactivatePromotion('request serial no', 1);
        $this->assertPreviousRequest('POST', 'promotion/activity/deactivate');
    }

    public function testRemovePromotionItem()
    {
        $this->caller->removePromotionItem('request serial no', 'id');
        $this->assertPreviousRequest('POST', 'promotion/activity/items/remove');
    }
}
