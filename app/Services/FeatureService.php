<?php

namespace App\Services;


use App\Entities\Feature as FeatureEntity;
use App\Exceptions\ValidationErrorException;
use App\Repositories\Interfaces\FeatureRepositoryInterface;
use App\Services\Interfaces\FeatureServiceInterface;
use App\Validators\Base\Validator;
use App\Validators\FeatureValidator;


class FeatureService implements FeatureServiceInterface
{
    /**
     * @param FeatureRepositoryInterface $featureRepository
     */
    public function __construct(
        private FeatureRepositoryInterface $featureRepository
    ) {
    }

    /**
     * @param array $productFields
     * @return FeatureEntity
     * @throws ValidationErrorException
     */
    public function createFeature(array $productFields): FeatureEntity
    {
        $featureEntity = new FeatureEntity();
        $featureEntity->setFeatureName($productFields['featureName']);
        $featureEntity->setFeatureDescription($productFields['description']);

        $featureValidator = new FeatureValidator(
            $featureEntity,
            FeatureValidator::ACTION_CREATE,
            null
        );
        $validator = new Validator($featureValidator);
        $validator->validate();

        return $this->featureRepository->save($featureEntity, true);
    }
}
