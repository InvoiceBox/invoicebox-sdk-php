<?php

namespace Invoicebox\Sdk\Client;

class InvoiceboxClientFactory
{
    private ?HttpClient $client;

    public function __construct(?HttpClient $client = null)
    {
        $this->client = $client;
    }

    public function createClient(
        string $authKey,
        ?string $apiUrl = null,
        ?string $version = null
    ): InvoiceboxClient {
        $client = $this->client ?? new HttpClient();
        return new InvoiceboxClient(
            $authKey,
            $version,
            $apiUrl,
            $client,
        );
    }
}