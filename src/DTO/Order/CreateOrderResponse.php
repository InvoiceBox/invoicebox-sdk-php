<?php

namespace Invoicebox\Sdk\DTO\Order;

use Invoicebox\Sdk\Exception\InvalidArgument;

class CreateOrderResponse extends CreateOrderRequest
{
    private string $id;

    private string $paymentUrl;

    private string $createdAt;

    private string $status;

    public function getId(): string
    {
        return $this->id;
    }

    public function getPaymentUrl(): string
    {
        return $this->paymentUrl;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getOrderContainerId(): string
    {
        return $this->orderContainerId;
    }

    public static function fromArray(array $responseData): CreateOrderResponse
    {
        try {
            $basketItems = [];
            foreach ($responseData['basketItems'] as $basketItem) {
                $basketItems[] = BasketItem::fromArray($basketItem);
            }

            $response = new self(
                $responseData['description'],
                $responseData['merchantId'],
                $responseData['merchantOrderId'],
                $responseData['amount'],
                $responseData['vatAmount'],
                $responseData['currencyId'],
                new \DateTime($responseData['expirationDate']),
                $basketItems,
                LegalCustomer::fromArray($responseData['customer']),
                $responseData['merchantOrderIdVisible'] ?? null,
                $responseData['metaData'] ?? null,
                $responseData['languageId'] ?? null,
                $responseData['notificationUrl'] ?? null,
                $responseData['successUrl'] ?? null,
                $responseData['failUrl'] ?? null,
                $responseData['returnUrl'] ?? null,
                isset($responseData['invoiceSetting']) ? InvoiceSetting::fromArray(
                    $responseData['invoiceSetting']
                ) : null,
                isset($responseData['orderSetting']) ? OrderSetting::fromArray(
                    $responseData['orderSetting']
                ) : null,
                $responseData['parentId'] ?? null,
                $responseData['orderContainerId'] ?? null,
            );

            $response->id = $responseData['id'];
            $response->paymentUrl = $responseData['paymentUrl'];
            $response->description = $responseData['description'];
            $response->createdAt = $responseData['createdAt'];
            $response->status = $responseData['status'];
            $response->orderContainerId = $responseData['orderContainerId'];
        } catch (\Exception $exception) {
            throw new InvalidArgument('Not enough data');
        }

        return $response;
    }
}
