<?php

namespace Invoicebox\Sdk\DTO\CreateOrderRequest;

class LegalCustomer extends PrivateCustomer
{
    private string $vatNumber;
    private string $registrationAddress;

    public function __construct(
        string $name,
        string $phone,
        string $email,
        string $vatNumber,
        string $registrationAddress
    ) {
        parent::__construct($name, $phone, $email);
        $this->type = 'legal';
        $this->vatNumber = $vatNumber;
        $this->registrationAddress = $registrationAddress;
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
        return array_merge(parent::toArray(), [$this->vatNumber, $this->registrationAddress]);
    }
}
