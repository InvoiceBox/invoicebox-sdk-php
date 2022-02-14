<?php

namespace Invoicebox\Sdk\DTO\CreateOrderRequest;

use JMS\Serializer\Annotation\Type;

class CreateOrderRequest
{
    private string $description;
    private string $merchantId;
    private string $merchantOrderId;
    private float $amount;
    private float $vatAmount;
    private string $currencyId;
    private ?string $languageId = null;
    private \DateTimeInterface $expirationDate;
    /**
     * @Type("array<Invoicebox\Sdk\DTO\CreateOrderCartItem>")
     */
    private array $cartItems;
    private Customer $customer;
    private ?string $notificationUrl = null;
    private ?string $successUrl = null;
    private ?string $failUrl = null;
    private ?string $returnUrl = null;

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getMerchantId(): string
    {
        return $this->merchantId;
    }

    public function setMerchantId(string $merchantId): void
    {
        $this->merchantId = $merchantId;
    }

    public function getMerchantOrderId(): string
    {
        return $this->merchantOrderId;
    }

    public function setMerchantOrderId(string $merchantOrderId): void
    {
        $this->merchantOrderId = $merchantOrderId;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    public function getVatAmount(): float
    {
        return $this->vatAmount;
    }

    public function setVatAmount(float $vatAmount): void
    {
        $this->vatAmount = $vatAmount;
    }

    public function getCurrencyId(): string
    {
        return $this->currencyId;
    }

    public function setCurrencyId(string $currencyId): void
    {
        $this->currencyId = $currencyId;
    }

    public function getLanguageId(): ?string
    {
        return $this->languageId;
    }

    public function setLanguageId(?string $languageId): void
    {
        $this->languageId = $languageId;
    }

    public function getExpirationDate(): \DateTimeInterface
    {
        return $this->expirationDate;
    }

    public function setExpirationDate(\DateTimeInterface $expirationDate): void
    {
        $this->expirationDate = $expirationDate;
    }

    /**
     * @return array<CartItem>
     */
    public function getCartItems(): array
    {
        return $this->cartItems;
    }

    public function setCartItems(array $cartItems): void
    {
        $this->cartItems = $cartItems;
    }

    public function getCustomer()
    {
        return $this->customer;
    }

    public function setCustomer($customer): void
    {
        $this->customer = $customer;
    }

    public function getNotificationUrl(): ?string
    {
        return $this->notificationUrl;
    }

    public function setNotificationUrl(?string $notificationUrl): void
    {
        $this->notificationUrl = $notificationUrl;
    }

    public function getSuccessUrl(): ?string
    {
        return $this->successUrl;
    }

    public function setSuccessUrl(?string $successUrl): void
    {
        $this->successUrl = $successUrl;
    }

    public function getFailUrl(): ?string
    {
        return $this->failUrl;
    }

    public function setFailUrl(?string $failUrl): void
    {
        $this->failUrl = $failUrl;
    }

    public function getReturnUrl(): ?string
    {
        return $this->returnUrl;
    }

    public function setReturnUrl(?string $returnUrl): void
    {
        $this->returnUrl = $returnUrl;
    }


}
