<?php

namespace Invoicebox\Sdk\DTO\Order;

use DateTimeInterface;

class OrderNotification
{
    private string $id;

    private string $status;

    private string $merchantId;

    private string $merchantOrderId;

    private float $amount;

    private string $currencyId;

    private DateTimeInterface $createdAt;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getMerchantId(): string
    {
        return $this->merchantId;
    }

    public function setMerchantId(string $merchantId): void
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

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    public function getCurrencyId(): string
    {
        return $this->currencyId;
    }

    public function setCurrencyId(string $currencyId): void
    {
        $this->currencyId = $currencyId;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public static function fromArray(array $responseData): OrderNotification
    {
        $orderNotification = new self();
        $orderNotification->setStatus($responseData['status']);
        $orderNotification->setMerchantId($responseData['merchantId']);
        $orderNotification->setMerchantOrderId($responseData['merchantOrderId']);
        $orderNotification->setAmount($responseData['amount']);
        $orderNotification->setCurrencyId($responseData['currencyId']);
        $orderNotification->setCreatedAt(new \DateTime($responseData['createdAt']));

        return $orderNotification;
    }
}
