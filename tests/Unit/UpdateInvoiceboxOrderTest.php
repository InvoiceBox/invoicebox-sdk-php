<?php

namespace Invoicebox\Sdk\Tests\Unit;

use Invoicebox\Sdk\Client\InvoiceboxClient;
use Invoicebox\Sdk\DTO\UpdateOrderRequest;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class UpdateInvoiceboxOrderTest extends TestCase
{
    /**
     * @test
     */
    public function getInvoiceboxOrder()
    {
        $mock = new MockHttpClient();
        $mock->setResponseFactory(
            new MockResponse(file_get_contents('./tests/mock/success-update-order-response.json'))
        );

        $mockClient = new InvoiceboxClient(
            $mock,
            '',
            'b37c4c689295904ed21eee5d9a48d42e',
            'ffffffff-ffff-ffff-ffff-ffffffffffff'
        );

        $request = new UpdateOrderRequest();
        $request->setDescription('Проездной');


        $response = $mockClient->updateOrder('017f2c3c-e880-4a08-abc6-7bd3117eea2d', $request);

        $this->assertNotNull($response);
        $this->assertEquals('Проездной', $response->getDescription());
    }
}
