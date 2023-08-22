<?php

namespace Invoicebox\Sdk\Client;

class HttpResponse
{
    public string $response;

    public function __construct($response)
    {
        $this->response = $response;
    }

    public function toArray(bool $throw = true): array
    {
        if ($this->response === '') {
            return [];
        }

        return json_decode($this->response, true);
    }
}
