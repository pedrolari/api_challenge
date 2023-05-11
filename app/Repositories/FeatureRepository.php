<?php

namespace App\Repositories;

use App\Entities\Feature as FeatureEntity;
use App\Models\Feature;
use App\Repositories\Interfaces\FeatureRepositoryInterface;

class FeatureRepository implements FeatureRepositoryInterface
{

    /**
     * @param int $id
     * @return FeatureEntity
     */
    public function findById(int $id): FeatureEntity
    {
        /** @var Feature $config */
        $feature = Feature::where('id', $id)->first();

        return $feature->toEntity();
    }

    /**
     * @param FeatureEntity $featureEntity
     * @param bool $isNewFeature
     * @return FeatureEntity
     */
    public function save(FeatureEntity $featureEntity, bool $isNewFeature = false): FeatureEntity
    {
        $featureModel = $isNewFeature ? new Feature() : Feature::find($featureEntity->getId());
        $featureModel->feature_name = $featureEntity->getFeatureName();
        $featureModel->description = $featureEntity->getFeatureDescription();
        $featureModel->save();

        return $isNewFeature ? $featureModel->refresh()->toEntity() : $featureModel->toEntity();
    }
}
