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

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getVatNumber(): string
    {
        return $this->vatNumber;
    }

    public function setVatNumber(string $vatNumber): void
    {
        $this->vatNumber = $vatNumber;
    }

    public function getRegistrationAddress(): string
    {
        return $this->registrationAddress;
    }

    public function setRegistrationAddress(string $registrationAddress): void
    {
        $this->registrationAddress = $registrationAddress;
    }


}
