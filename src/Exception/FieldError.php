<?php

namespace Invoicebox\Sdk\Exception;

class FieldError
{
    public const TYPE_WRONG_VALUE = 'wrong_value';

    private string $name;
    private string $code;
    private string $message;

    public function __construct(string $field, string $message, ?string $code = null)
    {
        $this->name = $field;
        $this->message = $message;
        $this->code = $code ?? self::TYPE_WRONG_VALUE;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function toArray() : array
    {
        return [
            'name' => $this->name,
            'code' => $this->code,
            'message' => $this->message,
        ];
    }
}
