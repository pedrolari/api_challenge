<?php

namespace App\Validators\Base;

class ViolationBuilder
{
    private ?Violation $currentViolation;
    private array $violations;


    public function __construct()
    {
        $this->violations = [];
        $this->currentViolation = null;
    }


    /**
     * @param string $message
     * @return $this
     */
    public function buildViolation(string $message): self
    {
        $this->currentViolation = new Violation($message);

        return $this;
    }


    /**
     * @param string $path
     * @return $this
     */
    public function atPath(string $path): self
    {
        $this->currentViolation?->setPath($path);

        return $this;
    }


    /**
     * @param int $code
     * @return $this
     */
    public function code(int $code): self
    {
        $this->currentViolation?->setCode($code);

        return $this;
    }


    /**
     * @return void
     */
    public function addViolation(): void
    {
        if ($this->currentViolation) {
            $this->violations[] = $this->currentViolation;
        }
    }


    /**
     * @return array
     */
    public function getViolations(): array
    {
        return $this->violations;
    }
}
