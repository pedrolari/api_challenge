<?php

namespace App\Services\Interfaces;

use App\Entities\Product;
use App\Entities\Product as ProductEntity;

interface ProductServiceInterface
{

    /**
     * @param array $productFields
     * @return Product
     */
    public function createProduct(array $productFields): Product;

    /**
     * @param int $id
     *
     * @return Product
     */
    public function getProduct(int $id): Product;

    /**
     * @param ProductEntity $productEntity
     * @param array $validateFields
     * @return ProductEntity
     */
    public function updateProduct(ProductEntity $productEntity, array $validateFields): ProductEntity;
}
