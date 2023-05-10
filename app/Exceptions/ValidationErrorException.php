<?php

namespace App\Exceptions;

use App\Validators\Base\Violation;

class ValidationErrorException extends \Exception
{
    public function __construct(private array $violations = [])
    {
        $violationMsg = 'violations: [';
        $numOfViolations = count($this->violations);

        foreach ($violations as $index => $violation) {
            if ($violation instanceof Violation) {
                $violationMsg .= $violation->getMessage();
                if ($index !== $numOfViolations - 1) {
                    $violationMsg .= ', ';
                }
            }
        }

        $violationMsg .= ']';

        parent::__construct($violationMsg);
    }


    /**
     * @return array
     */
    public function getViolations(): array
    {
        return $this->violations;
    }
}
