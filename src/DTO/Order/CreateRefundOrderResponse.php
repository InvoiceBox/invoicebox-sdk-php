<?php

namespace Invoicebox\Sdk\DTO\Order;

use Invoicebox\Sdk\Exception\InvalidArgument;

class CreateRefundOrderResponse extends CreateRefundOrderRequest
{
    private string $id;

    private string $merchantId;

    private string $currencyId;

    private string $createdAt;

    public static function fromArray(array $responseData): CreateRefundOrderResponse
    {
        try {
            $basketItems = [];
            foreach ($responseData['basketItems'] as $basketItem) {
                $basketItems[] = BasketItem::fromArray($basketItem);
            }

            $response = new self(
                $responseData['parentId'],
                $responseData['merchantOrderId'],
                $responseData['amount'],
                $responseData['vatAmount'],
                $basketItems,
                $responseData['description'],
                $responseData['status'],
            );

            $response->id = $responseData['id'];
            $response->merchantId = $responseData['merchantId'];
            $response->currencyId = $responseData['currencyId'];
            $response->createdAt = $responseData['createdAt'];
        } catch (\Exception $exception) {
            throw new InvalidArgument('Not enough data');
        }

        return $response;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getMerchantId(): string
    {
        return $this->merchantId;
    }

    public function setMerchantId(string $merchantId): void
    {
        $this->merchantId = $merchantId;
    }

    public function getCurrencyId(): string
    {
        return $this->currencyId;
    }

    public function setCurrencyId(string $currencyId): void
    {
        $this->currencyId = $currencyId;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}
