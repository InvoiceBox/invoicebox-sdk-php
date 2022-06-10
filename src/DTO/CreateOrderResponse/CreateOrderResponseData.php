<?php

namespace Invoicebox\Sdk\DTO\CreateOrderResponse;

use Invoicebox\Sdk\Exception\InvalidArgument;

class CreateOrderResponseData
{
    private string $id;
    private string $paymentUrl;
    private string $description;
    private string $createdAt;
    private string $status;
    private string $orderContainerId;

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

    public static function fromArray(array $responseData): CreateOrderResponseData
    {
        $response = new self();
        try {
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
