<?php

namespace Invoicebox\Sdk\DTO\CreateOrderResponse;

class CreateOrderResponse
{
    private CreateOrderResponseData $data;

    public function getData(): CreateOrderResponseData
    {
        return $this->data;
    }

    public function fromArray(array $arrayData)
    {
        $responseData = new CreateOrderResponseData();
        try {
            $this->data = $responseData->fromArray($arrayData['data']);
        } catch (\Exception $exception) {

        }
    }
}
