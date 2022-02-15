<?php

namespace Invoicebox\Sdk\DTO\CreateOrderRequest;

class CartItem
{
    private string $sku;
    private string $name;
    private string $measure;
    private string $measureCode;
    private float $quantity;
    private float $amount;
    private float $totalAmount;
    private float $totalVatAmount;
    private ?float $excise = null;
    private string $vatCode;
    private string $type;
    private string $paymentType;
    private float $amountWoVat;

    public function __construct(
        string $sku,
        string $name,
        string $measure,
        string $measureCode,
        float $quantity,
        float $amount,
        float $totalAmount,
        float $totalVatAmount,
        string $vatCode,
        string $type,
        string $paymentType,
        float $amountWoVat
    )
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->measure = $measure;
        $this->measureCode = $measureCode;
        $this->quantity = $quantity;
        $this->amount = $amount;
        $this->totalAmount = $totalAmount;
        $this->totalVatAmount = $totalVatAmount;
        $this->vatCode = $vatCode;
        $this->type = $type;
        $this->paymentType = $paymentType;
        $this->amountWoVat = $amountWoVat;
    }

    public function setExcise(?float $excise): void
    {
        $this->excise = $excise;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getMeasure(): string
    {
        return $this->measure;
    }

    public function getMeasureCode(): string
    {
        return $this->measureCode;
    }

    public function getQuantity(): float
    {
        return $this->quantity;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getTotalAmount(): float
    {
        return $this->totalAmount;
    }

    public function getTotalVatAmount(): float
    {
        return $this->totalVatAmount;
    }

    public function getExcise(): ?float
    {
        return $this->excise;
    }

    public function getVatCode(): string
    {
        return $this->vatCode;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getPaymentType(): string
    {
        return $this->paymentType;
    }

    public function getAmountWoVat(): float
    {
        return $this->amountWoVat;
    }

    public function toArray(): array
    {
        return [
            $this->sku,
            $this->name,
            $this->measure,
            $this->measureCode,
            $this->quantity,
            $this->amount,
            $this->totalAmount,
            $this->totalVatAmount,
            $this->excise,
            $this->vatCode,
            $this->type,
            $this->paymentType,
            $this->amountWoVat
        ];
    }
}
