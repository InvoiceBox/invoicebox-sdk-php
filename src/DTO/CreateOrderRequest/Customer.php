<?php

namespace Invoicebox\Sdk\DTO\CreateOrderRequest;

class Customer
{
    private string $type;
    private string $name;
    private string $phone;
    private string $email;
    private string $vatNumber;
    private string $registrationAddress;

    public function __construct(
        string $type,
        string $name,
        string $phone,
        string $email,
        string $vatNumber,
        string $registrationAddress
    ) {
        $this->type = $type;
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
        $this->vatNumber = $vatNumber;
        $this->registrationAddress = $registrationAddress;
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

    public function getVatNumber(): string
    {
        return $this->vatNumber;
    }

    public function getRegistrationAddress(): string
    {
        return $this->registrationAddress;
    }

    public function toArray(): array
    {
        return [
            $this->type,
            $this->name,
            $this->phone,
            $this->email,
            $this->vatNumber,
            $this->registrationAddress
        ];
    }
}
