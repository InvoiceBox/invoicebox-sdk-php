<?php

namespace Invoicebox\Sdk\Client;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class InvoiceboxClientFactory
{
    private HttpClientInterface $client;

    public function __construct(
        HttpClientInterface $client
    ) {
        $this->client = $client;
    }

    public function createClient(
        string $authKey,
        ?string $apiUrl = null,
        ?string $version = null
    ): InvoiceboxClient {
        return new InvoiceboxClient(
            $this->client,
            $authKey,
            $apiUrl,
            $version
        );
    }
}
