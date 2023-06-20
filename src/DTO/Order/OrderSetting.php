<?php

namespace Invoicebox\Sdk\DTO\Order;

class OrderSetting
{
    private ?string $roundPolicy;

    public function __construct(
        ?string $roundPolicy = null
    ) {
        $this->roundPolicy = $roundPolicy;
    }

    public function getRoundPolicy(): ?string
    {
        return $this->roundPolicy;
    }

    public function toArray(): array
    {
        return array_filter(
            [
                'roundPolicy' => $this->roundPolicy,
            ],
            fn ($value) => !is_null($value)
        );
    }

    public static function fromArray($responseData): OrderSetting
    {
        return new self(
            $responseData['roundPolicy'] ?? null,
        );
    }
}
