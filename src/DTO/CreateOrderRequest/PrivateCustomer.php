<?php

namespace Invoicebox\Sdk\DTO\CreateOrderRequest;

class PrivateCustomer
{
    protected string $type = 'private';
    protected string $name;
    protected string $phone;
    protected string $email;

    public function __construct(
        string $name,
        string $phone,
        string $email
    ) {
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function toArray(): array
    {
        return [
            $this->type,
            $this->name,
            $this->phone,
            $this->email
        ];
    }
}
