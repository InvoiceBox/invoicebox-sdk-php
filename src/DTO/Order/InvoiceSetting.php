<?php

namespace Invoicebox\Sdk\DTO\Order;

class InvoiceSetting
{
    private ?bool $customerLocked;

    private ?array $customerLockedFields;

    public function __construct(
        ?bool $customerLocked = null,
        ?array $customerLockedFields = null
    ) {
        $this->customerLocked = $customerLocked;
        $this->customerLockedFields = $customerLockedFields;
    }

    public function getCustomerLocked(): ?bool
    {
        return $this->customerLocked;
    }

    public function getCustomerLockedFields(): ?array
    {
        return $this->customerLockedFields;
    }

    public function toArray(): array
    {
        return array_filter([
            'customerLocked' => $this->customerLocked,
            'customerLockedFields' => $this->customerLockedFields,
        ], fn ($value) => !is_null($value));
    }

    public static function fromArray($responseData): InvoiceSetting
    {
        return new self(
            $responseData['customerLocked'] ?? null,
            $responseData['customerLockedFields'] ?? null,
        );
    }
}
