<?php

namespace Invoicebox\Sdk\DTO\Order;

class BasketItem
{
    private string $sku;

    private string $name;

    private ?string $groupName;

    private string $measure;

    private string $measureCode;

    private ?string $originCountry;

    private ?string $originCountryCode;

    private ?float $grossWeight;

    private ?float $netWeight;

    private float $quantity;

    private float $amount;

    private float $amountWoVat;

    private float $totalAmount;

    private float $totalVatAmount;

    private ?float $excise;

    private string $vatCode;

    private string $type;

    private string $paymentType;

    private ?array $metaData;

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
        string $paymentType,
        ?string $groupName = null,
        ?string $originCountry = null,
        ?string $originCountryCode = null,
        ?float $grossWeight = null,
        ?float $netWeight = null,
        ?float $excise = null,
        ?array $metaData = null
    ) {
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
        $this->groupName = $groupName;
        $this->originCountry = $originCountry;
        $this->originCountryCode = $originCountryCode;
        $this->grossWeight = $grossWeight;
        $this->netWeight = $netWeight;
        $this->excise = $excise;
        $this->metaData = $metaData;
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

    public function getGroupName(): ?string
    {
        return $this->groupName;
    }

    public function getOriginCountry(): ?string
    {
        return $this->originCountry;
    }

    public function getOriginCountryCode(): ?string
    {
        return $this->originCountryCode;
    }

    public function getGrossWeight(): ?float
    {
        return $this->grossWeight;
    }

    public function getNetWeight(): ?float
    {
        return $this->netWeight;
    }

    public function getMetaData(): ?array
    {
        return $this->metaData;
    }

    public function toArray(): array
    {
        return array_filter([
            'sku' => $this->sku,
            'name' => $this->name,
            'measure' => $this->measure,
            'measureCode' => $this->measureCode,
            'quantity' => $this->quantity,
            'amount' => $this->amount,
            'amountWoVat' => $this->amountWoVat,
            'totalAmount' => $this->totalAmount,
            'totalVatAmount' => $this->totalVatAmount,
            'vatCode' => $this->vatCode,
            'type' => $this->type,
            'paymentType' => $this->paymentType,
            'excise' => $this->excise,
            'groupName' => $this->groupName,
            'originCountry' => $this->originCountry,
            'originCountryCode' => $this->originCountryCode,
            'grossWeight' => $this->grossWeight,
            'netWeight' => $this->netWeight,
            'metaData' => $this->metaData,
        ], fn ($value) => !is_null($value));
    }

    public static function fromArray(array $data)
    {
        return new self(
            $data['sku'],
            $data['name'],
            $data['measure'],
            $data['measureCode'],
            $data['quantity'],
            $data['amount'],
            $data['amountWoVat'],
            $data['totalAmount'],
            $data['totalVatAmount'],
            $data['vatCode'],
            $data['type'],
            $data['paymentType'],
            $data['groupName'] ?? null,
            $data['originCountry'] ?? null,
            $data['originCountryCode'] ?? null,
            $data['grossWeight'] ?? null,
            $data['netWeight'] ?? null,
            $data['excise'] ?? null,
            $data['metaData'] ?? null
        );
    }
}
