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

class ProductTest extends TestResource
{
    public function testCreateProduct()
    {
        $this->caller->createProduct([]);
        $this->assertPreviousRequest('POST', 'products');
    }

    public function testCreateDraftProduct()
    {
        $this->caller->createDraftProduct([]);
        $this->assertPreviousRequest('POST', 'products/save_draft');
    }

    public function testGetProductList()
    {
        $this->caller->getProductList();
        $this->assertPreviousRequest('POST', 'products/search');
    }

    public function testGetAttributes()
    {
        $this->caller->getAttributes(1);
        $this->assertPreviousRequest('GET', 'products/attributes');
    }

    public function testDeactivateProduct()
    {
        $this->caller->deactivateProduct([]);
        $this->assertPreviousRequest('POST', 'products/inactivated_products');
    }

    public function testActivateProduct()
    {
        $this->caller->activateProduct([]);
        $this->assertPreviousRequest('POST', 'products/activate');
    }

    public function testRecoverDeletedProduct()
    {
        $this->caller->recoverDeletedProduct([]);
        $this->assertPreviousRequest('POST', 'products/recover');
    }

    public function testGetCategories()
    {
        $this->caller->getCategories();
        $this->assertPreviousRequest('GET', 'products/categories');
    }

    public function testGetBrands()
    {
        $this->caller->getBrands([]);
        $this->assertPreviousRequest('GET', 'products/brands');
    }

    public function testCreateBrand()
    {
        $this->caller->createBrand('sample brand');
        $this->assertPreviousRequest('POST', 'products/brand');
    }

    public function testDeleteProduct()
    {
        $this->caller->deleteProduct([]);
        $this->assertPreviousRequest('DELETE', 'products');
    }

    public function testUploadFile()
    {
        $this->caller->uploadFile('file content');
        $this->assertPreviousRequest('POST', 'products/upload_files');
    }

    public function testUploadImage()
    {
        $this->caller->uploadImage('file content');
        $this->assertPreviousRequest('POST', 'products/upload_imgs');
    }

    public function testGetProductDetail()
    {
        $this->caller->getProductDetail(1);
        $this->assertPreviousRequest('GET', 'products/details');
    }

    public function testEditProduct()
    {
        $this->caller->editProduct(1, []);
        $this->assertPreviousRequest('PUT', 'products');
    }

    public function testUpdateStock()
    {
        $this->caller->updateStock(1, []);
        $this->assertPreviousRequest('PUT', 'products/stocks');
    }

    public function testUpdatePrice()
    {
        $this->caller->updatePrice(1, []);
        $this->assertPreviousRequest('PUT', 'products/prices');
    }

    public function testGetCategoryRule()
    {
        $this->caller->getCategoryRule(1);
        $this->assertPreviousRequest('GET', 'products/categories/rules');
    }

    public function testCategoryRecommended()
    {
        $this->caller->categoryRecommended('product name', 'description');
        $this->assertPreviousRequest('POST', 'product/category_recommend');
    }
}
