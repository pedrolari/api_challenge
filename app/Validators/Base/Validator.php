<?php

namespace App\Validators\Base;

use App\Exceptions\ValidationErrorException;

class Validator
{
    /**
     * @param Validatable $validatable
     */
    public function __construct(private Validatable $validatable)
    {
    }


    /**
     * @return void
     * @throws ValidationErrorException
     */
    public function validate(): void
    {
        $builder = new ViolationBuilder();
        $this->validatable->validate($builder);
        $violations = $builder->getViolations();

        if ($violations) {
            throw new ValidationErrorException($violations);
        }
    }
}
