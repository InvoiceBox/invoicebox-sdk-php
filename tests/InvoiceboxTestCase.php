<?php

namespace Invoicebox\Sdk\Tests;

use Invoicebox\Sdk\Client\InvoiceboxClient;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class InvoiceboxTestCase extends TestCase
{
    public function createMockClient(string $responseFile): InvoiceboxClient
    {
        $mock = new MockHttpClient();
        $mock->setResponseFactory(
            new MockResponse(file_get_contents(__DIR__ . '/' . $responseFile))
        );

        return new InvoiceboxClient(
            $mock,
            'b37c4c689295904ed21eee5d9a48d42e',
        );
    }
}
