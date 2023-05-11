<?php

namespace App\Repositories;

use App\Entities\Feature as FeatureEntity;
use App\Entities\Product as ProductEntity;
use App\Entities\ProductFeature as ProductFeatureEntity;
use App\Models\ProductFeature;
use App\Repositories\Interfaces\ProductFeatureRepositoryInterface;

class ProductFeatureRepository implements ProductFeatureRepositoryInterface
{

    /**
     * @param int $product_id
     * @param int $feature_id
     * @return ProductFeatureEntity|null
     */
    public function findById(int $product_id, int $feature_id): ?ProductFeatureEntity
    {
        /** @var ProductFeature $productFeature */
        $productFeature = ProductFeature::where('product_id', $product_id)
            ->where('feature_id', $feature_id)
            ->first();

        return $productFeature?->toEntity();
    }


    /**
     * @param ProductEntity $productEntity
     * @param FeatureEntity $featureEntity
     * @return ProductFeatureEntity
     */
        public function save(ProductEntity $productEntity, FeatureEntity $featureEntity): ProductFeatureEntity
    {
        $productFeatureModel = new ProductFeature();
        $productFeatureModel->product_id = $productEntity->getId();
        $productFeatureModel->feature_id = $featureEntity->getId();
        $productFeatureModel->save();

        return $productFeatureModel->toEntity();
    }
}
