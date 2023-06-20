<?php

namespace Invoicebox\Sdk\DTO\Order;

class LegalCustomer extends PrivateCustomer
{
    private ?string $vatNumber = null;

    private ?string $registrationAddress = null;

    public function __construct(
        ?string $name = null,
        ?string $phone = null,
        ?string $email = null,
        ?string $vatNumber = null,
        ?string $registrationAddress = null
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
        return array_filter([
            'type' => $this->type,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'vatNumber' => $this->vatNumber,
            'registrationAddress' => $this->registrationAddress,
        ]);
    }

    /**
     * @return PrivateCustomer|LegalCustomer
     */
    public static function fromArray(array $data): PrivateCustomer
    {
        if ($data['type'] == 'private') {
            return parent::fromArray($data);
        } else {
            return new self(
                $data['name'],
                $data['phone'],
                $data['email'],
                $data['vatNumber'],
                $data['registrationAddress']
            );
        }
    }
}
