<?php

namespace App\Services\Interfaces;

use App\Entities\Feature as FeatureEntity;
use App\Entities\Product as ProductEntity;
use App\Entities\ProductFeature as ProductFeatureEntity;

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

    /**
     * @param ProductEntity $productEntity
     * @param FeatureEntity $featureEntity
     * @return ProductFeatureEntity
     */
    public function associateProduct(
        ProductEntity $productEntity,
        FeatureEntity $featureEntity
    ): ProductFeatureEntity;
}
