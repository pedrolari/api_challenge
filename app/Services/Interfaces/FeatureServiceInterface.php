<?php

namespace App\Services\Interfaces;

use App\Entities\Feature as FeatureEntity;

interface FeatureServiceInterface
{

    /**
     * @param array $productFields
     * @return FeatureEntity
     */
    public function createFeature(array $productFields): FeatureEntity;

    /**
     * @param int $id
     * @return FeatureEntity
     */
    public function getFeature(int $id): FeatureEntity;
}
