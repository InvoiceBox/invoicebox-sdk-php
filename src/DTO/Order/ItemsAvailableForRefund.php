<?php

namespace Invoicebox\Sdk\DTO\Order;

class ItemsAvailableForRefund
{
    /**
     * @var BasketItem[]
     */
    protected array $basketItems;

    public function __construct(
        array $basketItems
    ) {
        $this->basketItems = $basketItems;
    }

    public function getBasketItems(): array
    {
        return $this->basketItems;
    }

    public function setBasketItems(array $basketItems): void
    {
        $this->basketItems = $basketItems;
    }

    public static function fromArray(array $responseData): ItemsAvailableForRefund
    {
        $basketItems = [];
        foreach ($responseData as $basketItem) {
            $basketItems[] = BasketItem::fromArray($basketItem);
        }
        return new self($basketItems);
    }
}
