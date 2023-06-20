<?php

namespace Invoicebox\Sdk\DTO\Order;

use DateTimeInterface;

class CreateOrderRequest
{
    protected string $description;

    protected string $merchantId;

    protected string $merchantOrderId;

    protected ?string $merchantOrderIdVisible;

    protected float $amount;

    protected float $vatAmount;

    protected string $currencyId;

    protected ?string $languageId;

    protected DateTimeInterface $expirationDate;

    /**
     * @var BasketItem[]
     */
    protected array $basketItems;

    protected ?array $metaData;

    /**
     * @var null|LegalCustomer|PrivateCustomer
     */
    protected $customer;

    protected ?string $notificationUrl;

    protected ?string $successUrl;

    protected ?string $failUrl;

    protected ?string $returnUrl;

    protected ?InvoiceSetting $invoiceSetting;

    protected ?OrderSetting $orderSetting;

    protected ?string $parentId;

    protected ?string $orderContainerId;

    /**
     * @param null|LegalCustomer|PrivateCustomer $customer
     * @param BasketItem[] $basketItems
     */
    public function __construct(
        string $description,
        string $merchantId,
        string $merchantOrderId,
        float $amount,
        float $vatAmount,
        string $currencyId,
        DateTimeInterface $expirationDate,
        array $basketItems,
        $customer,
        ?string $merchantOrderIdVisible = null,
        ?array $metaData = null,
        ?string $languageId = null,
        ?string $notificationUrl = null,
        ?string $successUrl = null,
        ?string $failUrl = null,
        ?string $returnUrl = null,
        ?InvoiceSetting $invoiceSetting = null,
        ?OrderSetting $orderSetting = null,
        ?string $parentId = null,
        ?string $orderContainerId = null
    ) {
        $this->description = $description;
        $this->merchantId = $merchantId;
        $this->merchantOrderId = $merchantOrderId;
        $this->amount = $amount;
        $this->vatAmount = $vatAmount;
        $this->currencyId = $currencyId;
        $this->languageId = $languageId;
        $this->expirationDate = $expirationDate;
        $this->basketItems = $basketItems;
        $this->customer = $customer;
        $this->merchantOrderIdVisible = $merchantOrderIdVisible;
        $this->metaData = $metaData;
        $this->notificationUrl = $notificationUrl;
        $this->successUrl = $successUrl;
        $this->failUrl = $failUrl;
        $this->returnUrl = $returnUrl;
        $this->invoiceSetting = $invoiceSetting;
        $this->orderSetting = $orderSetting;
        $this->parentId = $parentId;
        $this->orderContainerId = $orderContainerId;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getMerchantId(): ?string
    {
        return $this->merchantId;
    }

    public function setMerchantId(?string $merchantId): void
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

    public function getMerchantOrderIdVisible(): ?string
    {
        return $this->merchantOrderIdVisible;
    }

    public function setMerchantOrderIdVisible(?string $merchantOrderIdVisible): void
    {
        $this->merchantOrderIdVisible = $merchantOrderIdVisible;
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

    public function getExpirationDate(): DateTimeInterface
    {
        return $this->expirationDate;
    }

    public function setExpirationDate(DateTimeInterface $expirationDate): void
    {
        $this->expirationDate = $expirationDate;
    }

    /**
     * @return BasketItem[]
     */
    public function getBasketItems(): array
    {
        return $this->basketItems;
    }

    /**
     * @param BasketItem[] $basketItems
     */
    public function setBasketItems(array $basketItems): void
    {
        $this->basketItems = $basketItems;
    }

    public function getMetaData(): ?array
    {
        return $this->metaData;
    }

    public function setMetaData(?array $metaData): void
    {
        $this->metaData = $metaData;
    }

    /**
     * @return LegalCustomer|PrivateCustomer|null
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param null|LegalCustomer|PrivateCustomer $customer
     */
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

    public function getInvoiceSetting(): ?InvoiceSetting
    {
        return $this->invoiceSetting;
    }

    public function setInvoiceSetting(?InvoiceSetting $invoiceSetting): void
    {
        $this->invoiceSetting = $invoiceSetting;
    }

    public function getOrderSetting(): ?OrderSetting
    {
        return $this->orderSetting;
    }

    public function setOrderSetting(?OrderSetting $orderSetting): void
    {
        $this->orderSetting = $orderSetting;
    }

    public function getParentId(): ?string
    {
        return $this->parentId;
    }

    public function setParentId(?string $parentId): void
    {
        $this->parentId = $parentId;
    }

    public function getOrderContainerId(): ?string
    {
        return $this->orderContainerId;
    }

    public function setOrderContainerId(?string $orderContainerId): void
    {
        $this->orderContainerId = $orderContainerId;
    }

    public function addBasketItem(BasketItem $basketItem)
    {
        $this->basketItems[] = $basketItem;
    }

    public function toArray(): array
    {
        $baketItemsArray = [];
        foreach ($this->basketItems as $basketItem) {
            $baketItemsArray[] = $basketItem->toArray();
        }

        return array_filter([
            'description' => $this->description,
            'merchantId' => $this->merchantId,
            'merchantOrderId' => $this->merchantOrderId,
            'merchantOrderIdVisible' => $this->merchantOrderIdVisible,
            'amount' => $this->amount,
            'vatAmount' => $this->vatAmount,
            'currencyId' => $this->currencyId,
            'languageId' => $this->languageId,
            'expirationDate' => $this->expirationDate->format('Y-m-d\TH:i:sP'),
            'basketItems' => $baketItemsArray,
            'metaData' => $this->metaData,
            'customer' => $this->customer ? $this->customer->toArray() : null,
            'notificationUrl' => $this->notificationUrl,
            'successUrl' => $this->successUrl,
            'failUrl' => $this->failUrl,
            'returnUr' => $this->returnUrl,
            'invoiceSetting' => $this->invoiceSetting ? $this->invoiceSetting->toArray() : null,
            'orderSetting' => $this->orderSetting ? $this->orderSetting->toArray() : null,
            'parentId' => $this->parentId,
            'orderContainerId' => $this->orderContainerId,
        ], fn ($value) => !is_null($value));
    }
}
