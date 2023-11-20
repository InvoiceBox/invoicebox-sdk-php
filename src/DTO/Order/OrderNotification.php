<?php

namespace Invoicebox\Sdk\DTO\Order;

use DateTimeInterface;

class OrderNotification
{
    private string $id;

    private string $status;

    private string $merchantId;

    private string $merchantOrderId;

    private string $merchantOrderIdVisible;

    private float $amount;

    /**
     * @var PrivateCustomer|LegalCustomer
     */
    private PrivateCustomer $customer;

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

    public function getMerchantOrderIdVisible(): string
    {
        return $this->merchantOrderIdVisible;
    }

    public function setMerchantOrderIdVisible(string $merchantOrderIdVisible): void
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

    /**
     * @return PrivateCustomer|LegalCustomer
     */
    public function getCustomer(): PrivateCustomer
    {
        return $this->customer;
    }

    public function setCustomer($customer): void
    {
        $this->customer = LegalCustomer::fromArray($customer);
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
        $orderNotification->setId($responseData['id']);
        $orderNotification->setStatus($responseData['status']);
        $orderNotification->setMerchantId($responseData['merchantId']);
        $orderNotification->setMerchantOrderId($responseData['merchantOrderId']);
        if (isset($responseData['merchantOrderIdVisible'])) {
            $orderNotification->setMerchantOrderIdVisible($responseData['merchantOrderIdVisible']);
        }
        $orderNotification->setAmount($responseData['amount']);
        $orderNotification->setCustomer($responseData['customer']);
        $orderNotification->setCurrencyId($responseData['currencyId']);
        $orderNotification->setCreatedAt(new \DateTime($responseData['createdAt']));

        return $orderNotification;
    }
}
