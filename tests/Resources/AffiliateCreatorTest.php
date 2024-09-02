<?php
/*
 * This file is part of tiktokshop-php.
 *
 * Copyright (c) 2024 Jin <j@sax.vn> All rights reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EcomPHP\TiktokShop\Tests\Resources;

use EcomPHP\TiktokShop\Tests\TestResource;

/**
 * @property-read \EcomPHP\TiktokShop\Resources\AffiliateCreator $caller
 */
class AffiliateCreatorTest extends TestResource
{
    public const TEST_API_VERSION = 202405;

    public function testAddShowcaseProducts()
    {
        $this->caller->addShowcaseProducts('add_type', [1, 2, 3], 'product_link');
        $this->assertPreviousRequest('POST', 'affiliate_creator/'.self::TEST_API_VERSION.'/showcases/products/add');
    }

    public function testGetShowcaseProducts()
    {
        $this->caller->getShowcaseProducts();
        $this->assertPreviousRequest('GET', 'affiliate_creator/'.self::TEST_API_VERSION.'/showcases/products');
    }

    public function testGetCreatorProfile()
    {
        $this->caller->getCreatorProfile();
        $this->assertPreviousRequest('GET', 'affiliate_creator/'.self::TEST_API_VERSION.'/profiles');
    }

    public function testSearchOpenCollaborationProduct()
    {
        $this->caller->searchOpenCollaborationProduct();
        $this->assertPreviousRequest('POST', 'affiliate_creator/'.self::TEST_API_VERSION.'/open_collaborations/products/search');
    }

    public function testSearchTargetCollaborations()
    {
        $this->caller->searchTargetCollaborations([]);
        $this->assertPreviousRequest('POST', 'affiliate_creator/'.self::TEST_API_VERSION.'/target_collaborations/search');
    }

    public function testSearchAffiliateOrders()
    {
        $this->caller->searchAffiliateOrders();
        $this->assertPreviousRequest('POST', 'affiliate_creator/'.self::TEST_API_VERSION.'/orders/search');
    }
}
