<?php

namespace Invoicebox\Sdk\Tests\Request;

use Invoicebox\Sdk\Tests\InvoiceboxTestCase;

class DeleteOrderTest extends InvoiceboxTestCase
{
    /**
     * @test
     */
    public function getInvoiceboxOrder()
    {
        $mockClient = $this->createMockClient('mock/success-delete-order-response.json');

        $response = $mockClient->deleteOrder('017f3012-555e-cac6-65b8-28fcc3512273');

        $this->assertNotNull($response);
        $this->assertEquals('canceled', $response->getStatus());
    }
}
