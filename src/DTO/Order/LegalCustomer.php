<?php

namespace Invoicebox\Sdk\DTO\Order;

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
        return [
            'type' => $this->type,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'vatNumber' => $this->vatNumber,
            'registrationAddress' => $this->registrationAddress,
        ];
    }
}
