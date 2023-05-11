<?php

namespace App\Validators;

use App\Entities\Product;
use App\Validators\Base\Validatable;
use App\Validators\Base\ViolationBuilder;

class ProductValidator implements Validatable
{
    public const ACTION_CREATE = 'create';
    public const ACTION_UPDATE = 'update';


    /**
     * @param Product $product
     * @param string $action
     * @param array|null $validateFields
     */
    public function __construct(
        private Product $product,
        private string $action,
        private ?array $validateFields
    ) {
    }

    public function validate(ViolationBuilder $builder): void
    {
        match ($this->action) {
            self::ACTION_CREATE => $this->validateCreate($builder),
            self::ACTION_UPDATE => $this->validateUpdate($builder),
        };
    }

    /**
     * @param ViolationBuilder $builder
     *
     * @return void
     */
    private function validateCreate(ViolationBuilder $builder): void
    {
        if (strlen($this->product->getName()) <= 3) {
            $builder
                ->buildViolation('Product name must be at least 3 characters long.')
                ->atPath('product')
                ->addViolation();
        }
    }


    /**
     * @param ViolationBuilder $builder
     * @return void
     */
    private function validateUpdate(ViolationBuilder $builder): void
    {
        if (strlen($this->product->getName()) <= 3) {
            $builder
                ->buildViolation('Product name must be at least 3 characters long.')
                ->atPath('product')
                ->addViolation();
        }

        if (!is_bool($this->validateFields['onSale'])) {
            $builder
                ->buildViolation('Product On Sale must be boolean.')
                ->atPath('product')
                ->addViolation();
        }
    }
}
