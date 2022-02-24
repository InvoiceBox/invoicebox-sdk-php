<?php

namespace Invoicebox\Sdk\Tests\Unit;

use Invoicebox\Sdk\Client\InvoiceboxClient;
use Invoicebox\Sdk\DTO\Filter\Filter;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class GetInvoiceboxOrderTest extends TestCase
{
    /**
     * @test
     */
    public function getInvoiceboxOrder()
    {
        $mock = new MockHttpClient();
        $mock->setResponseFactory(
            new MockResponse(file_get_contents('./tests/mock/success-get-order-response.json'))
        );

        $mockClient = new InvoiceboxClient(
            $mock,
            'b37c4c689295904ed21eee5d9a48d42e',
            'ffffffff-ffff-ffff-ffff-ffffffffffff'
        );

        $filter = new Filter();
        $filter->addEqual('merchantId',  'ffffffff-ffff-ffff-ffff-ffffffffffff');


        $response = $mockClient->findOrderByFilter($filter);

        $this->assertNotNull($response);
        $this->assertEquals(2, count($response));
        $this->assertEquals('017f1b5a-b677-a228-2951-b3523dbbd836', $response[0]->getId());
        $this->assertEquals('017f0713-8238-0019-4772-f1cc6bab2e88', $response[1]->getId());
    }
}
