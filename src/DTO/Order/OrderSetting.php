<?php

namespace Invoicebox\Sdk\DTO\Order;

class OrderSetting
{
    private ?string $roundPolicy;

    private ?bool $disableValidate;

    public function __construct(
        ?string $roundPolicy = null,
        ?bool $disableValidate = null
    ) {
        $this->roundPolicy = $roundPolicy;
        $this->disableValidate = $disableValidate;
    }

    public function getRoundPolicy(): ?string
    {
        return $this->roundPolicy;
    }

    public function getDisableValidate(): ?bool
    {
        return $this->disableValidate;
    }

    public function toArray(): array
    {
        return array_filter(
            [
                'roundPolicy' => $this->roundPolicy,
                'disableValidate' => $this->disableValidate,
            ],
            fn ($value) => !is_null($value)
        );
    }

    public static function fromArray($responseData): OrderSetting
    {
        return new self(
            $responseData['roundPolicy'] ?? null,
            $responseData['disableValidate'] ?? null,
        );
    }
}
