<?php

namespace Invoicebox\Sdk\Tests\Unit;

use Invoicebox\Sdk\Client\InvoiceboxClient;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class DeleteInvoiceboxOrderTest extends TestCase
{
    /**
     * @test
     */
    public function getInvoiceboxOrder()
    {
        $mock = new MockHttpClient();
        $mock->setResponseFactory(
            new MockResponse(file_get_contents('./tests/mock/success-delete-order-response.json'))
        );

        $mockClient = new InvoiceboxClient(
            $mock,
            'b37c4c689295904ed21eee5d9a48d42e',
            'ffffffff-ffff-ffff-ffff-ffffffffffff'
        );

        $response = $mockClient->deleteOrder('017f3012-555e-cac6-65b8-28fcc3512273');

        $this->assertNotNull($response);
        $this->assertEquals('canceled', $response->getStatus());
    }
}
