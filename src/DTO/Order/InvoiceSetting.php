<?php

namespace Invoicebox\Sdk\DTO\Order;

class InvoiceSetting
{
    private ?bool $customerLocked;

    private ?array $customerLockedFields;

    private ?bool $paymentMethodIdLocked;

    private ?int $paymentMethodId;
    private ?array $customerHiddenFields;

    public function __construct(
        ?bool $customerLocked = null,
        ?array $customerLockedFields = null,
        ?bool $paymentMethodIdLocked = null,
        ?int $paymentMethodId = null,
        ?array $customerHiddenFields = null
    ) {
        $this->customerLocked = $customerLocked;
        $this->customerLockedFields = $customerLockedFields;
        $this->paymentMethodIdLocked = $paymentMethodIdLocked;
        $this->paymentMethodId = $paymentMethodId;
        $this->customerHiddenFields = $customerHiddenFields;
    }

    public function getCustomerLocked(): ?bool
    {
        return $this->customerLocked;
    }

    public function getCustomerLockedFields(): ?array
    {
        return $this->customerLockedFields;
    }

    public function getPaymentMethodIdLocked(): ?bool
    {
        return $this->paymentMethodIdLocked;
    }

    public function getPaymentMethodId(): ?int
    {
        return $this->paymentMethodId;
    }

    public function getCustomerHiddenFields(): ?array
    {
        return $this->customerHiddenFields;
    }

    public function toArray(): array
    {
        return array_filter([
            'customerLocked' => $this->customerLocked,
            'customerLockedFields' => $this->customerLockedFields,
            'paymentMethodIdLocked' => $this->paymentMethodIdLocked,
            'paymentMethodId' => $this->paymentMethodId,
            'customerHiddenFields' => $this->customerHiddenFields,
        ], fn($value) => !is_null($value));
    }

    public static function fromArray($responseData): InvoiceSetting
    {
        return new self(
            $responseData['customerLocked'] ?? null,
            $responseData['customerLockedFields'] ?? null,
            $responseData['paymentMethodIdLocked'] ?? null,
            $responseData['paymentMethodId'] ?? null,
            $responseData['customerHiddenFields'] ?? null,
        );
    }
}
