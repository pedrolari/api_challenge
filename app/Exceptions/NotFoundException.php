<?php

namespace App\Exceptions;

class NotFoundException extends \Exception
{
    public function __construct(private string $valueNotFound = '')
    {
        parent::__construct($this->getValueNotFound());
    }


    /**
     * @return string
     */
    public function getValueNotFound(): string
    {
        return trim($this->valueNotFound . ' not found');
    }
}
