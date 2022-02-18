<?php

namespace Invoicebox\Src\Tests\Unit;

use Invoicebox\Sdk\Client\InvoiceboxClient;
use Invoicebox\Sdk\DTO\CreateOrderRequest\CartItem;
use Invoicebox\Sdk\DTO\CreateOrderRequest\CreateOrderRequest;
use Invoicebox\Sdk\DTO\CreateOrderRequest\Customer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class CreateInvoiceboxOrderTest extends TestCase
{
    /**
     * @test
     */
    public function createInvoiceboxOrder()
    {
        $mock = new MockHttpClient();
        $mock->setResponseFactory(
            new MockResponse(file_get_contents('./tests/mock/success-create-order-response.json'))
        );

        $mockClient = new InvoiceboxClient(
            $mock,
            'b37c4c689295904ed21eee5d9a48d42e',
            'ffffffff-ffff-ffff-ffff-ffffffffffff'
        );
        $response = $mockClient->createOrder(
            new CreateOrderRequest(
                'Проездной билет',
                '1',
                2790.67,
                0.0,
                'RUB',
                new \DateTime('yesterday'),
                [
                    $this->addCartItem()
                ],
                $this->setCustomer()
            )
        );

        $this->assertNotNull($response);
        $this->assertEquals( '017f038f-c78b-736d-dc00-8bce30bd0f9f', $response->getId());
    }

    private function addCartItem(): CartItem
    {
        return new CartItem(
            '0123456789',
            'Black Edition',
            'шт.',
            '796',
            1.0,
            2790.67,
            2790.67,
            0.0,
            'VATNONE',
            'commodity',
            'full_prepayment',
            2790.67
        );
    }

    private function setCustomer(): Customer
    {
        return new Customer(
            'private',
            'OOO TEST',
            '78121111111',
            'test@test.test',
            '123321',
            '123321, Колотушкина, 1, 1'
        );
    }
}
