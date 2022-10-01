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

class GlobalProductTest extends TestResource
{

    public function testGetGlobalCategories()
    {
        $this->caller->getGlobalCategories();
        $this->assertPreviousRequest('GET', 'product/global_products/categories');
    }

    public function testEditGlobalProduct()
    {
        $this->caller->editGlobalProduct(1, []);
        $this->assertPreviousRequest('PUT', 'product/global_products');
    }

    public function testGetGlobalProductList()
    {
        $this->caller->getGlobalProductList();
        $this->assertPreviousRequest('POST', 'product/global_products/search');
    }

    public function testPublishGlobalProduct()
    {
        $this->caller->publishGlobalProduct(1, []);
        $this->assertPreviousRequest('POST', 'product/global_products/publish');
    }

    public function testGetGlobalAttributes()
    {
        $this->caller->getGlobalAttributes(1);
        $this->assertPreviousRequest('GET', 'product/global_products/attributes');
    }

    public function testGetGlobalCategoryRule()
    {
        $this->caller->getGlobalCategoryRule(1);
        $this->assertPreviousRequest('GET', 'product/global_products/categories/rules');
    }

    public function testGetGlobalProductDetail()
    {
        $this->caller->getGlobalProductDetail(1);
        $this->assertPreviousRequest('GET', 'product/global_products');
    }

    public function testCreateGlobalProduct()
    {
        $this->caller->createGlobalProduct(1, []);
        $this->assertPreviousRequest('POST', 'product/global_products');
    }

    public function testUpdateGlobalProductPrice()
    {
        $this->caller->updateGlobalProductPrice(1, []);
        $this->assertPreviousRequest('PUT', 'product/global_products/prices');
    }
}
