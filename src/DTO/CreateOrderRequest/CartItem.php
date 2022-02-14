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

    public function getSku(): string
    {
        return $this->sku;
    }

    public function setSku(string $sku): void
    {
        $this->sku = $sku;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getMeasure(): string
    {
        return $this->measure;
    }

    public function setMeasure(string $measure): void
    {
        $this->measure = $measure;
    }

    public function getMeasureCode(): string
    {
        return $this->measureCode;
    }

    public function setMeasureCode(string $measureCode): void
    {
        $this->measureCode = $measureCode;
    }

    public function getQuantity(): float
    {
        return $this->quantity;
    }

    public function setQuantity(float $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): void
    {
        $this->amount = round($amount, 2);
    }

    public function getTotalAmount(): float
    {
        return $this->totalAmount;
    }

    public function setTotalAmount(float $totalAmount): void
    {
        $this->totalAmount = round($totalAmount, 2);
    }

    public function getTotalVatAmount(): float
    {
        return $this->totalVatAmount;
    }

    public function setTotalVatAmount(float $totalVatAmount): void
    {
        $this->totalVatAmount = round($totalVatAmount, 2);
    }

    public function getExcise(): ?float
    {
        return $this->excise;
    }

    public function setExcise(float $excise): void
    {
        $this->excise = $excise;
    }

    public function getVatCode(): string
    {
        return $this->vatCode;
    }

    public function setVatCode(string $vatCode): void
    {
        $this->vatCode = $vatCode;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getPaymentType(): string
    {
        return $this->paymentType;
    }

    public function setPaymentType(string $paymentType): void
    {
        $this->paymentType = $paymentType;
    }

    public function getAmountWoVat(): float
    {
        return $this->amountWoVat;
    }

    public function setAmountWoVat(float $amountWoVat): void
    {
        $this->amountWoVat = round($amountWoVat, 2);
    }


}
