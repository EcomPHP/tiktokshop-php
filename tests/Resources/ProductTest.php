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

use EcomPHP\TiktokShop\Resources\Product;
use EcomPHP\TiktokShop\Tests\TestResource;
use PHPUnit\Framework\TestCase;

/**
 * @property-read \EcomPHP\TiktokShop\Resources\Product $caller
 */
class ProductTest extends TestResource
{

    public function testDeactivateProducts()
    {
        $this->caller->deactivateProducts([]);
        $this->assertPreviousRequest('POST', 'product/'.TestResource::TEST_API_VERSION.'/products/deactivate');
    }

    public function testGetBrands()
    {
        $this->caller->getBrands([]);
        $this->assertPreviousRequest('GET', 'product/'.TestResource::TEST_API_VERSION.'/brands');
    }

    public function testCreateProduct()
    {
        $this->caller->createProduct([]);
        $this->assertPreviousRequest('POST', 'product/'.TestResource::TEST_API_VERSION.'/products');
    }

    public function testSearchProducts()
    {
        $this->caller->searchProducts([]);
        $this->assertPreviousRequest('POST', 'product/'.TestResource::TEST_API_VERSION.'/products/search');
    }

    public function testGetAttributes()
    {
        $this->caller->getAttributes(1009);
        $this->assertPreviousRequest('GET', 'product/'.TestResource::TEST_API_VERSION.'/categories/1009/attributes');
    }

    public function testUploadProductImage()
    {
        $this->caller->uploadProductImage('php://memory');
        $this->assertPreviousRequest('POST', 'product/'.TestResource::TEST_API_VERSION.'/images/upload');
    }

    public function testGetProduct()
    {
        $this->caller->getProduct(1009);
        $this->assertPreviousRequest('GET', 'product/'.TestResource::TEST_API_VERSION.'/products/1009');
    }

    public function testUploadProductFile()
    {
        $this->caller->uploadProductFile('php://memory');
        $this->assertPreviousRequest('POST', 'product/'.TestResource::TEST_API_VERSION.'/files/upload');
    }

    public function testUpdateInventory()
    {
        $this->caller->updateInventory(1009, []);
        $this->assertPreviousRequest('POST', 'product/'.TestResource::TEST_API_VERSION.'/products/1009/inventory/update');
    }

    public function testInventorySearch()
    {
        $this->caller->inventorySearch([]);
        $this->assertPreviousRequest('POST', 'product/'.TestResource::TEST_API_VERSION.'/inventory/search');
    }

    public function testDeleteProducts()
    {
        $this->caller->deleteProducts([]);
        $this->assertPreviousRequest('DELETE', 'product/'.TestResource::TEST_API_VERSION.'/products');
    }

    public function testEditProduct()
    {
        $this->caller->editProduct(1009, []);
        $this->assertPreviousRequest('PUT', 'product/'.TestResource::TEST_API_VERSION.'/products/1009');
    }

    public function testActivateProducts()
    {
        $this->caller->activateProducts([]);
        $this->assertPreviousRequest('POST', 'product/'.TestResource::TEST_API_VERSION.'/products/activate');
    }

    public function testPartialEditProduct()
    {
        $this->caller->partialEditProduct(1009, []);
        $this->assertPreviousRequest('POST', 'product/'.TestResource::TEST_API_VERSION.'/products/1009/partial_edit');
    }

    public function testRecommendCategory()
    {
        $this->caller->recommendCategory([]);
        $this->assertPreviousRequest('POST', 'product/'.TestResource::TEST_API_VERSION.'/categories/recommend');
    }

    public function testCheckListingPrerequisites()
    {
        $this->caller->checkListingPrerequisites([]);
        $this->assertPreviousRequest('GET', 'product/'.TestResource::TEST_API_VERSION.'/prerequisites');
    }

    public function testUpdatePrice()
    {
        $this->caller->updatePrice(1009, []);
        $this->assertPreviousRequest('POST', 'product/'.TestResource::TEST_API_VERSION.'/products/1009/prices/update');
    }

    public function testGetCategoryRules()
    {
        $this->caller->getCategoryRules(1009);
        $this->assertPreviousRequest('GET', 'product/'.TestResource::TEST_API_VERSION.'/categories/1009/rules');
    }

    public function testGetCategories()
    {
        $this->caller->getCategories([]);
        $this->assertPreviousRequest('GET', 'product/'.TestResource::TEST_API_VERSION.'/categories');
    }

    public function testRecoverProducts()
    {
        $this->caller->recoverProducts([]);
        $this->assertPreviousRequest('POST', 'product/'.TestResource::TEST_API_VERSION.'/products/recover');
    }

    public function testCreateCustomBrand()
    {
        $this->caller->createCustomBrand([]);
        $this->assertPreviousRequest('POST', 'product/'.TestResource::TEST_API_VERSION.'/brands');
    }
}
