<?php

namespace App\Exceptions;

class ConflictException extends \Exception
{
    public function __construct(private string $valueExists = '')
    {
        parent::__construct($this->getValueNotFound());
    }


    /**
     * @return string
     */
    public function getValueNotFound(): string
    {
        return trim($this->valueExists . ' exist');
    }
}
