<?php

namespace App\Repositories\Interfaces;

use App\Entities\Feature as FeatureEntity;
use App\Entities\Product as ProductEntity;
use App\Entities\ProductFeature as ProductFeatureEntity;

interface ProductFeatureRepositoryInterface
{
    /**
     * @param int $product_id
     * @param int $feature_id
     * @return ProductFeatureEntity|null
     */
    public function findById(int $product_id, int $feature_id): ?ProductFeatureEntity;

    /**
     * @param ProductEntity $productEntity
     * @param FeatureEntity $featureEntity
     * @return ProductFeatureEntity
     */
    public function save(ProductEntity $productEntity, FeatureEntity $featureEntity): ProductFeatureEntity;
}
