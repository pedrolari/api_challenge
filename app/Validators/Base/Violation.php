<?php

namespace App\Validators\Base;

class Violation
{
    public const NO_CODE = 0;

    private string $path;
    private int $code;


    /**
     * @param string $message
     */
    public function __construct(private string $message)
    {
        $this->path = '';
        $this->code = self::NO_CODE;
    }


    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }


    /**
     * @param string $message
     * @return $this
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }


    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }


    /**
     * @param string $path
     * @return $this
     */
    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }


    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }


    /**
     * @param int $code
     * @return $this
     */
    public function setCode(int $code): self
    {
        $this->code = $code;

        return $this;
    }
}
