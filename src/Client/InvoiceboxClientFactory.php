<?php

namespace Invoicebox\Sdk\Client;

//use Symfony\Contracts\HttpClient\HttpClientInterface;

class InvoiceboxClientFactory
{
    private HttpClient $client;

    public function __construct(
        HttpClient $client
    ) {
        $this->client = $client;
    }

    public function createClient(
        string $authKey,
        ?string $apiUrl = null,
        ?string $version = null
    ): InvoiceboxClient {
        return new InvoiceboxClient(
            $authKey,
            $apiUrl,
            $version,
            $this->client,
        );
    }
}
