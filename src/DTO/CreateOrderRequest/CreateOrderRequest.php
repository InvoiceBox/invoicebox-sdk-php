<?php

namespace Invoicebox\Sdk\DTO\CreateOrderRequest;

class CreateOrderRequest
{
    private string $description;
    private ?string $merchantId;
    private string $merchantOrderId;
    private float $amount;
    private float $vatAmount;
    private string $currencyId;
    private ?string $languageId = null;
    private \DateTimeInterface $expirationDate;
    /**
     * @var CartItem[]
     */
    private array $cartItems;
    /**
     * @var LegalCustomer|PrivateCustomer
     */
    private $customer;
    private ?string $notificationUrl = null;
    private ?string $successUrl = null;
    private ?string $failUrl = null;
    private ?string $returnUrl = null;

    /**
     * @param LegalCustomer|PrivateCustomer $customer
     */
    public function __construct(
        string $description,
        string $merchantOrderId,
        float $amount,
        float $vatAmount,
        string $currencyId,
        \DateTimeInterface $expirationDate
    )
    {
        $this->description = $description;
        $this->merchantOrderId = $merchantOrderId;
        $this->amount = $amount;
        $this->vatAmount = $vatAmount;
        $this->currencyId = $currencyId;
        $this->expirationDate = $expirationDate;
    }

    /**
     * @return CartItem[]
     */
    public function getCartItems(): array
    {
        return $this->cartItems;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getMerchantId(): string
    {
        return $this->merchantId;
    }

    public function getMerchantOrderId(): string
    {
        return $this->merchantOrderId;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getVatAmount(): float
    {
        return $this->vatAmount;
    }

    public function getCurrencyId(): string
    {
        return $this->currencyId;
    }

    public function getLanguageId(): ?string
    {
        return $this->languageId;
    }

    public function getExpirationDate(): \DateTimeInterface
    {
        return $this->expirationDate;
    }

    /**
     * @return PrivateCustomer|LegalCustomer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param PrivateCustomer|LegalCustomer $customer
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

    public function getNotificationUrl(): ?string
    {
        return $this->notificationUrl;
    }

    public function getSuccessUrl(): ?string
    {
        return $this->successUrl;
    }

    public function getFailUrl(): ?string
    {
        return $this->failUrl;
    }

    public function getReturnUrl(): ?string
    {
        return $this->returnUrl;
    }

    public function setLanguageId(?string $languageId): void
    {
        $this->languageId = $languageId;
    }

    public function setNotificationUrl(?string $notificationUrl): void
    {
        $this->notificationUrl = $notificationUrl;
    }

    public function setSuccessUrl(?string $successUrl): void
    {
        $this->successUrl = $successUrl;
    }

    public function setFailUrl(?string $failUrl): void
    {
        $this->failUrl = $failUrl;
    }

    public function setReturnUrl(?string $returnUrl): void
    {
        $this->returnUrl = $returnUrl;
    }

    public function setMerchantId(string $merchantId): void
    {
        $this->merchantId = $merchantId;
    }

    public function addCartItem(CartItem $cartItem)
    {
        $this->cartItems[] = $cartItem;
    }

    public function toArray(): array
    {
        $cartItemsArray = [];
        foreach ($this->cartItems as $cartItem) {
            $cartItemsArray[] = $cartItem->toArray();
        }

        return [
            $this->description,
            $this->merchantId,
            $this->merchantOrderId,
            $this->amount,
            $this->vatAmount,
            $this->currencyId,
            $this->languageId,
            $this->expirationDate,
            $cartItemsArray,
            $this->customer->toArray(),
            $this->notificationUrl,
            $this->successUrl,
            $this->failUrl,
            $this->returnUrl
        ];
    }
}
