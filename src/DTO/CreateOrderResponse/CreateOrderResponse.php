<?php

namespace Invoicebox\Sdk\DTO\CreateOrderResponse;

use Invoicebox\Sdk\Exception\InvalidArgument;

class CreateOrderResponse
{
    private CreateOrderResponseData $data;

    public function __construct(array $arrayData)
    {
        $responseData = new CreateOrderResponseData();

        if (isset($arrayData['data'])) {
            $this->data = $responseData->fromArray($arrayData['data']);
        } else {
            throw new InvalidArgument('Not enough data');
        }
    }

    public function getData(): CreateOrderResponseData
    {
        return $this->data;
    }
}
