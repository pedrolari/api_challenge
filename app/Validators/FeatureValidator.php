<?php

namespace App\Validators;

use App\Entities\Feature;
use App\Validators\Base\Validatable;
use App\Validators\Base\ViolationBuilder;

class FeatureValidator implements Validatable
{
    public const ACTION_CREATE = 'create';


    /**
     * @param Feature $feature
     * @param string $action
     * @param array|null $validateFields
     */
    public function __construct(
        private Feature $feature,
        private string $action,
        private ?array $validateFields
    ) {
    }

    public function validate(ViolationBuilder $builder): void
    {
        match ($this->action) {
            self::ACTION_CREATE => $this->validateCreate($builder)
        };
    }

    /**
     * @param ViolationBuilder $builder
     *
     * @return void
     */
    private function validateCreate(ViolationBuilder $builder): void
    {
        if (strlen($this->feature->getFeatureName()) <= 3) {
            $builder
                ->buildViolation('Feature name must be at least 3 characters long.')
                ->atPath('feature')
                ->addViolation();
        }

        if (strlen($this->feature->getFeatureDescription()) <= 3) {
            $builder
                ->buildViolation('Feature description must be at least 3 characters long.')
                ->atPath('feature')
                ->addViolation();
        }
    }
}
