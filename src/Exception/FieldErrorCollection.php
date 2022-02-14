<?php

namespace Invoicebox\Sdk\Exception;

class FieldErrorCollection
{
    private array $items = [];

    private function __construct()
    {
    }

    public static function create(): self
    {
        return new self();
    }


    public function add(
        string $field,
        string $message = '',
        ?string $code = null
    ): self {
        $this->items[] = new FieldError($field, $message, $code);

        return $this;
    }

    /**
     * @return FieldError[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
