<?php

namespace App\Validators\Base;

interface Validatable
{
    /**
     * @param ViolationBuilder $builder
     * @return void
     */
    public function validate(ViolationBuilder $builder): void;
}
