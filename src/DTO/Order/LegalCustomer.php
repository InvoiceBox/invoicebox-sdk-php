<?php

namespace Invoicebox\Sdk\DTO\Order;

class LegalCustomer extends PrivateCustomer
{
    private ?string $vatNumber = null;

    private ?string $taxRegistrationReasonCode = null;

    private ?string $registrationAddress = null;

    public function __construct(
        ?string $name = null,
        ?string $phone = null,
        ?string $email = null,
        ?string $vatNumber = null,
        ?string $registrationAddress = null,
        ?string $taxRegistrationReasonCode = null
    ) {
        parent::__construct($name, $phone, $email);
        $this->type = 'legal';
        $this->vatNumber = $vatNumber;
        $this->registrationAddress = $registrationAddress;
        $this->taxRegistrationReasonCode = $taxRegistrationReasonCode;
    }

    public function getVatNumber(): ?string
    {
        return $this->vatNumber;
    }

    public function getRegistrationAddress(): ?string
    {
        return $this->registrationAddress;
    }

    public function getTaxRegistrationReasonCode(): ?string
    {
        return $this->taxRegistrationReasonCode;
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
            'taxRegistrationReasonCode' => $this->taxRegistrationReasonCode,
        ]);
    }

    /**
     * @return PrivateCustomer|LegalCustomer
     */
    public static function fromArray(array $data): PrivateCustomer
    {
        if ($data['type'] === 'private') {
            return parent::fromArray($data);
        }
        return new self(
            $data['name'] ?? null,
            $data['phone'] ?? null,
            $data['email'] ?? null,
            $data['vatNumber'] ?? null,
            $data['registrationAddress'] ?? null,
            $data['taxRegistrationReasonCode'] ?? null,
        );
    }
}
