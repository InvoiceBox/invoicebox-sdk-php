<?php

namespace Invoicebox\Sdk\DTO\Order;

class CreateRefundOrderRequest
{
    private string $parentId;

    private string $merchantOrderId;

    private float $amount;

    private float $vatAmount;

    private array $basketItems;

    private string $description;

    private ?string $status;

    public function __construct(
        string $parentId,
        string $merchantOrderId,
        float $amount,
        float $vatAmount,
        array $basketItems,
        string $description,
        ?string $status = 'created'
    ) {
        $this->parentId = $parentId;
        $this->merchantOrderId = $merchantOrderId;
        $this->amount = $amount;
        $this->vatAmount = $vatAmount;
        $this->basketItems = $basketItems;
        $this->description = $description;
        $this->status = $status;
    }

    public function toArray(): array
    {
        $basketItems = [];
        foreach ($this->basketItems as $basketItem) {
            $basketItems[] = BasketItem::fromArray($basketItem);
        }

        return [
            'parentId' => $this->parentId,
            'merchantOrderId' => $this->merchantOrderId,
            'amount' => $this->amount,
            'vatAmount' => $this->vatAmount,
            'basketItems' => $basketItems,
            'description' => $this->description,
            'status' => $this->status,
        ];
    }

    public function getParentId(): string
    {
        return $this->parentId;
    }

    public function setParentId(string $parentId): void
    {
        $this->parentId = $parentId;
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

    public function getBasketItems(): array
    {
        return $this->basketItems;
    }

    public function setBasketItems(array $basketItems): void
    {
        $this->basketItems = $basketItems;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }
}
