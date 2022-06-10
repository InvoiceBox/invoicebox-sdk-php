<?php

namespace Invoicebox\Sdk\Client;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class InvoiceboxClientFactory
{
    public function __construct(
        private HttpClientInterface $client,
    ) {
    }

    public function createClient(
        string $apiUrl,
        string $authKey,
        string $merchantId
    ): InvoiceboxClient {
        return new InvoiceboxClient($this->client, $apiUrl, $authKey, $merchantId);
    }
}
