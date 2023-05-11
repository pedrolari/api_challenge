<?php

namespace App\Repositories\Interfaces;

use App\Entities\Feature as FeatureEntity;

interface FeatureRepositoryInterface
{
    /**
     * @param int $id
     * @return FeatureEntity
     */
    public function findById(int $id): FeatureEntity;

    /**
     * @param FeatureEntity $featureEntity
     * @param bool $isNewFeature
     * @return FeatureEntity
     */
    public function save(FeatureEntity $featureEntity, bool $isNewFeature = false): FeatureEntity;
}
