<?php

namespace Invoicebox\Sdk\Tests\Unit;

use Invoicebox\Sdk\Client\InvoiceboxClient;
use Invoicebox\Sdk\DTO\CreateOrderRequest\CartItem;
use Invoicebox\Sdk\DTO\CreateOrderRequest\CreateOrderRequest;
use Invoicebox\Sdk\DTO\CreateOrderRequest\LegalCustomer;
use Invoicebox\Sdk\Exception\InvalidArgument;
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

        $request = new CreateOrderRequest(
            'Проездной билет',
            '1',
            2790.67,
            0.0,
            'RUB',
            new \DateTime('yesterday')
        );
        $request->addCartItem(
            new CartItem(
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
            )
        );
        $request->setCustomer(
            new LegalCustomer(
                'OOO TEST',
                '78121111111',
                'test@test.test',
                '123321',
                '123321, Колотушкина, 1, 1'
            )
        );

        $response = $mockClient->createOrder($request);

        $this->assertNotNull($response);
        $this->assertEquals( '017f038f-c78b-736d-dc00-8bce30bd0f9f', $response->getId());
    }

    /**
     * @test
     */
    public function createInvoiceboxOrderWrongAmount()
    {
        $mock = new MockHttpClient();
        $mock->setResponseFactory(
            new MockResponse(file_get_contents('./tests/mock/wrong-amount-response.json'))
        );

        $mockClient = new InvoiceboxClient(
            $mock,
            'b37c4c689295904ed21eee5d9a48d42e',
            'ffffffff-ffff-ffff-ffff-ffffffffffff'
        );
        try {
            $request = new CreateOrderRequest(
                'Проездной билет',
                '1',
                2790.67,
                0.0,
                'RUB',
                new \DateTime('yesterday')
            );
            $request->addCartItem(
                new CartItem(
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
                )
            );
            $request->setCustomer(
                new LegalCustomer(
                    'OOO TEST',
                    '78121111111',
                    'test@test.test',
                    '123321',
                    '123321, Колотушкина, 1, 1'
                )
            );

            $mockClient->createOrder($request);

            $this->fail();
        } catch (InvalidArgument $exception) {
            $this->assertNotNull($exception);
            $this->assertEquals('Not enough data', $exception->getMessage());
        }

    }
}
