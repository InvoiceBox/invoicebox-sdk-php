<?php

namespace Invoicebox\Sdk\DTO;

use Invoicebox\Sdk\DTO\CreateOrderRequest\LegalCustomer;
use Invoicebox\Sdk\DTO\CreateOrderRequest\PrivateCustomer;
use Invoicebox\Sdk\DTO\UpdateOrderRequest\BasketItem;

class UpdateOrderRequest
{
    private ?string $description = null;
    private ?float $amount = null;
    private ?float $vatAmount = null;
    private ?\DateTimeInterface $expirationDate = null;
    /**
     * @var BasketItem[]|null
     */
    private ?array $basketItems = null;
    private ?object $metaData = null;
    /**
     * @var null|LegalCustomer|PrivateCustomer
     */
    private $customer = null;

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(?float $amount): void
    {
        $this->amount = $amount;
    }

    public function getVatAmount(): ?float
    {
        return $this->vatAmount;
    }

    public function setVatAmount(?float $vatAmount): void
    {
        $this->vatAmount = $vatAmount;
    }

    public function getExpirationDate(): ?\DateTimeInterface
    {
        return $this->expirationDate;
    }

    public function setExpirationDate(?\DateTimeInterface $expirationDate): void
    {
        $this->expirationDate = $expirationDate;
    }

    public function getBasketItems(): ?array
    {
        return $this->basketItems;
    }

    public function setBasketItems(?array $basketItems): void
    {
        $this->basketItems = $basketItems;
    }

    public function getMetaData(): ?object
    {
        return $this->metaData;
    }

    public function setMetaData(?object $metaData): void
    {
        $this->metaData = $metaData;
    }

    public function getCustomer()
    {
        return $this->customer;
    }

    public function setCustomer($customer): void
    {
        $this->customer = $customer;
    }

    public function toArray(): array
    {
        $basketItemsArray = [];

        if ($this->basketItems) {
            foreach ($this->basketItems as $basketItem) {
                $basketItemsArray[] = $basketItem->toArray();
            }
        } else {
            $basketItemsArray = null;
        }

        return [
            $this->description,
            $this->amount,
            $this->vatAmount,
            $this->expirationDate,
            $basketItemsArray,
            (array)$this->metaData,
            $this->customer ? $this->customer->toArray() : null
        ];
    }
}
