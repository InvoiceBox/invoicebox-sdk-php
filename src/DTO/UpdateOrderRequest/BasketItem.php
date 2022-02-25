<?php

namespace Invoicebox\Sdk\DTO\UpdateOrderRequest;

class BasketItem
{
    private string $sku;
    private string $name;
    private string $measure;
    private string $measureCode;
    private ?string $originCountry = null;
    private ?string $originCountryCode = null;
    private ?string $grossWeight = null;
    private ?string $netWeight = null;
    private float $quantity;
    private float $amount;
    private float $amountWoVat;
    private float $totalAmount;
    private float $totalVatAmount;
    private ?float $excise = null;
    private string $vatCode;
    private string $type;
    private string $paymentType;

    public function __construct(
        string $sku,
        string $name,
        string $measure,
        string $measureCode,
        float $quantity,
        float $amount,
        float $amountWoVat,
        float $totalAmount,
        float $totalVatAmount,
        string $vatCode,
        string $type,
        string $paymentType
    ) {
        $this->sku = $sku;
        $this->name = $name;
        $this->measure = $measure;
        $this->measureCode = $measureCode;
        $this->quantity = $quantity;
        $this->amount = $amount;
        $this->amountWoVat = $amountWoVat;
        $this->totalAmount = $totalAmount;
        $this->totalVatAmount = $totalVatAmount;
        $this->vatCode = $vatCode;
        $this->type = $type;
        $this->paymentType = $paymentType;
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

    public function getOriginCountry(): ?string
    {
        return $this->originCountry;
    }

    public function getOriginCountryCode(): ?string
    {
        return $this->originCountryCode;
    }

    public function getGrossWeight(): ?string
    {
        return $this->grossWeight;
    }

    public function getNetWeight(): ?string
    {
        return $this->netWeight;
    }

    public function getQuantity(): float
    {
        return $this->quantity;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getAmountWoVat(): float
    {
        return $this->amountWoVat;
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

    public function setOriginCountry(?string $originCountry): void
    {
        $this->originCountry = $originCountry;
    }

    public function setOriginCountryCode(?string $originCountryCode): void
    {
        $this->originCountryCode = $originCountryCode;
    }

    public function setGrossWeight(?string $grossWeight): void
    {
        $this->grossWeight = $grossWeight;
    }

    public function setNetWeight(?string $netWeight): void
    {
        $this->netWeight = $netWeight;
    }

    public function setExcise(?float $excise): void
    {
        $this->excise = $excise;
    }

    public function toArray(): array
    {
        return [
            $this->sku,
            $this->name,
            $this->measure,
            $this->measureCode,
            $this->originCountry,
            $this->originCountryCode,
            $this->grossWeight,
            $this->netWeight,
            $this->quantity,
            $this->amount,
            $this->amountWoVat,
            $this->totalAmount,
            $this->totalVatAmount,
            $this->excise,
            $this->vatCode,
            $this->type,
            $this->paymentType,
        ];
    }
}
