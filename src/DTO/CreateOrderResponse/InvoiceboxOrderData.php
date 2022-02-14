<?php

namespace Invoicebox\Sdk\DTO\CreateOrderResponse;

class InvoiceboxOrderData
{
    private string $id;
    private string $paymentUrl;
    private string $description;
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

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
