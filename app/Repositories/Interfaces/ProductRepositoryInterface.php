<?php

namespace App\Repositories\Interfaces;

use App\Entities\Product as ProductEntity;

interface ProductRepositoryInterface
{
    /**
     * @param int $id
     * @return ProductEntity
     */
    public function findById(int $id): ProductEntity;

    /**
     * @param ProductEntity $productEntity
     * @param bool $isNewProduct
     * @return ProductEntity
     */
    public function save(ProductEntity $productEntity, bool $isNewProduct = false): ProductEntity;
}
