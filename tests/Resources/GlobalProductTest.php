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

use EcomPHP\TiktokShop\Resources\GlobalProduct;
use EcomPHP\TiktokShop\Tests\TestResource;
use PHPUnit\Framework\TestCase;

/**
 * @property-read \EcomPHP\TiktokShop\Resources\GlobalProduct $caller
 */
class GlobalProductTest extends TestResource
{

    public function testGetGlobalCategories()
    {
        $this->caller->getGlobalCategories();
        $this->assertPreviousRequest('GET', 'product/'.TestResource::TEST_API_VERSION.'/global_categories');
    }

    public function testGetGlobalAttributes()
    {
        $this->caller->getGlobalAttributes(1009);
        $this->assertPreviousRequest('GET', 'product/'.TestResource::TEST_API_VERSION.'/categories/1009/global_attributes');
    }

    public function testGetGlobalCategoryRules()
    {
        $this->caller->getGlobalCategoryRules(1009);
        $this->assertPreviousRequest('GET', 'product/'.TestResource::TEST_API_VERSION.'/categories/1009/global_rules');
    }

    public function testUpdateGlobalInventory()
    {
        $this->caller->updateGlobalInventory(1009, []);
        $this->assertPreviousRequest('POST', 'product/'.TestResource::TEST_API_VERSION.'/global_products/1009/inventory/update');
    }

    public function testEditGlobalProduct()
    {
        $this->caller->editGlobalProduct(1009, []);
        $this->assertPreviousRequest('PUT', 'product/'.TestResource::TEST_API_VERSION.'/global_products/1009');
    }

    public function testSearchGlobalProducts()
    {
        $this->caller->searchGlobalProducts();
        $this->assertPreviousRequest('POST', 'product/'.TestResource::TEST_API_VERSION.'/global_products/search');
    }

    public function testGetGlobalProduct()
    {
        $this->caller->getGlobalProduct(1009);
        $this->assertPreviousRequest('GET', 'product/'.TestResource::TEST_API_VERSION.'/global_products/1009');
    }

    public function testDeleteGlobalProducts()
    {
        $this->caller->deleteGlobalProducts([]);
        $this->assertPreviousRequest('DELETE', 'product/'.TestResource::TEST_API_VERSION.'/global_products');
    }

    public function testCreateGlobalProduct()
    {
        $this->caller->createGlobalProduct([]);
        $this->assertPreviousRequest('POST', 'product/'.TestResource::TEST_API_VERSION.'/global_products');
    }

    public function testRecommendGlobalCategories()
    {
        $this->caller->recommendGlobalCategories([]);
        $this->assertPreviousRequest('POST', 'product/'.TestResource::TEST_API_VERSION.'/global_categories/recommend');
    }

    public function testPublishGlobalProduct()
    {
        $this->caller->publishGlobalProduct(1009, []);
        $this->assertPreviousRequest('POST', 'product/'.TestResource::TEST_API_VERSION.'/global_products/1009/publish');
    }
}
