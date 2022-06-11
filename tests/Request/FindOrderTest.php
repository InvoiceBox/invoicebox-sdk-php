<?php

namespace Invoicebox\Sdk\Tests\Request;

use Invoicebox\Sdk\DTO\Filter\Filter;
use Invoicebox\Sdk\Tests\InvoiceboxTestCase;

class FindOrderTest extends InvoiceboxTestCase
{
    /**
     * @test
     */
    public function getInvoiceboxOrder()
    {
        $mockClient = $this->createMockClient('mock/success-get-order-response.json');

        $filter = new Filter();
        $filter->addEqual('merchantId',  'ffffffff-ffff-ffff-ffff-ffffffffffff');


        $response = $mockClient->findOrderByFilter($filter);

        $this->assertNotNull($response);
        $this->assertEquals(2, count($response));
        $this->assertEquals('017f1b5a-b677-a228-2951-b3523dbbd836', $response[0]->getId());
        $this->assertEquals('017f0713-8238-0019-4772-f1cc6bab2e88', $response[1]->getId());
    }
}
