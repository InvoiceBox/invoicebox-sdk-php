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
        string $apiUrl,
        string $authKey,
        ?string $defaultMerchantId = null
    ): InvoiceboxClient {
        return new InvoiceboxClient(
            $this->client,
            $apiUrl,
            $authKey,
            $defaultMerchantId
        );
    }
}
