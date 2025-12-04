<?php

namespace Invoicebox\Sdk\Client;

readonly class InvoiceboxClientFactory
{
    public function __construct(
        private ?HttpClient $client = null
    ) {
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
