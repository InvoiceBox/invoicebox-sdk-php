<?php

namespace Invoicebox\Sdk\Tests\Request;

use Invoicebox\Sdk\DTO\Order\UpdateOrderRequest;
use Invoicebox\Sdk\Tests\InvoiceboxTestCase;

class UpdateOrderTest extends InvoiceboxTestCase
{
    /**
     * @test
     */
    public function getInvoiceboxOrder()
    {
        $mockClient = $this->createMockClient('mock/success-update-order-response.json');

        $request = new UpdateOrderRequest();
        $request->setDescription('Проездной');


        $response = $mockClient->updateOrder('017f2c3c-e880-4a08-abc6-7bd3117eea2d', $request);

        $this->assertNotNull($response);
        $this->assertEquals('Проездной', $response->getDescription());
    }
}
