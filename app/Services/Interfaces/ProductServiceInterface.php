<?php

namespace App\Services\Interfaces;

use App\Entities\Product as ProductEntity;

interface ProductServiceInterface
{

    /**
     * @param array $productFields
     * @return ProductEntity
     */
    public function createProduct(array $productFields): ProductEntity;

    /**
     * @param int $id
     *
     * @return ProductEntity
     */
    public function getProduct(int $id): ProductEntity;

    /**
     * @param ProductEntity $productEntity
     * @param array $validateFields
     * @return ProductEntity
     */
    public function updateProduct(ProductEntity $productEntity, array $validateFields): ProductEntity;
}
