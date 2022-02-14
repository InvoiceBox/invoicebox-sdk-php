<?php

namespace Invoicebox\Sdk\DTO\CreateOrderResponse;

class InvoiceboxOrderCreateResponse
{
    private ?InvoiceboxOrderData $data;

    public function getData(): ?InvoiceboxOrderData
    {
        return $this->data;
    }
}
