<?php

namespace Invoicebox\Sdk\DTO\CreateOrderResponse;

use Invoicebox\Sdk\Exception\InvalidArgument;

class CreateOrderResponse
{
    private CreateOrderResponseData $data;

    public function __construct(array $arrayData)
    {
        if (isset($arrayData['data'])) {
            $this->data = CreateOrderResponseData::fromArray($arrayData['data']);
        } else if (isset($arrayData['error'])) {
            throw new InvalidArgument($arrayData['error']['code']);
        }
    }

    public function getData(): CreateOrderResponseData
    {
        return $this->data;
    }
}
