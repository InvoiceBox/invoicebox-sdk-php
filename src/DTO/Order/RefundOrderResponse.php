<?php

namespace Invoicebox\Sdk\DTO\Order;

use Invoicebox\Sdk\Exception\InvalidArgument;

class RefundOrderResponse
{
    private string $id;

    private string $parentId;

    private string $description;

    private string $merchantOrderId;

    private string $merchantId;

    private float $amount;

    private float $vatAmount;

    private string $currencyId;

    /**
     * @var BasketItem[]
     */
    private array $basketItems;

    private string $createdAt;

    private string $status;

    public static function fromArray(array $responseData): array
    {
        $result = [];

        foreach ($responseData as $itemData) {
            if (!isset(
                $itemData['id'],
                $itemData['parentId'],
                $itemData['description'],
                $itemData['merchantOrderId'],
                $itemData['merchantId'],
                $itemData['amount'],
                $itemData['vatAmount'],
                $itemData['currencyId'],
                $itemData['basketItems'],
                $itemData['createdAt'],
                $itemData['status']
            )) {
                throw new InvalidArgument('Not enough data');
            }

            $basketItems = [];
            foreach ($itemData['basketItems'] as $basketItemData) {
                $basketItems[] = BasketItem::fromArray($basketItemData);
            }

            $response = new self();
            $response->id = $itemData['id'];
            $response->parentId = $itemData['parentId'];
            $response->description = $itemData['description'];
            $response->merchantOrderId = $itemData['merchantOrderId'];
            $response->merchantId = $itemData['merchantId'];
            $response->amount = $itemData['amount'];
            $response->vatAmount = $itemData['vatAmount'];
            $response->currencyId = $itemData['currencyId'];
            $response->basketItems = $basketItems;
            $response->createdAt = $itemData['createdAt'];
            $response->status = $itemData['status'];

            $result[] = $response;
        }

        return $result;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getParentId(): string
    {
        return $this->parentId;
    }

    public function setParentId(string $parentId): void
    {
        $this->parentId = $parentId;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getMerchantOrderId(): string
    {
        return $this->merchantOrderId;
    }

    public function setMerchantOrderId(string $merchantOrderId): void
    {
        $this->merchantOrderId = $merchantOrderId;
    }

    public function getMerchantId(): string
    {
        return $this->merchantId;
    }

    public function setMerchantId(string $merchantId): void
    {
        $this->merchantId = $merchantId;
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

    public function getBasketItems(): array
    {
        return $this->basketItems;
    }

    public function setBasketItems(array $basketItems): void
    {
        $this->basketItems = $basketItems;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
}
