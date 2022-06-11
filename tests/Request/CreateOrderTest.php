<?php

namespace Invoicebox\Sdk\Tests\Request;

use Invoicebox\Sdk\Client\InvoiceboxClient;
use Invoicebox\Sdk\Client\InvoiceboxHttpClient;
use Invoicebox\Sdk\DTO\Enum\BasketItemType;
use Invoicebox\Sdk\DTO\Enum\PaymentType;
use Invoicebox\Sdk\DTO\Enum\VatCode;
use Invoicebox\Sdk\DTO\Order\CartItem;
use Invoicebox\Sdk\DTO\Order\CreateOrderRequest;
use Invoicebox\Sdk\DTO\Order\LegalCustomer;
use Invoicebox\Sdk\Exception\InvalidArgument;
use Invoicebox\Sdk\Tests\InvoiceboxTestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class CreateOrderTest extends InvoiceboxTestCase
{
    /**
     * @test
     */
    public function createInvoiceboxOrder()
    {
        $mockClient = $this->createMockClient('mock/success-create-order-response.json');

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
                VatCode::VATNONE,
                BasketItemType::COMMODITY,
                PaymentType::FULL_PREPAYMENT,
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
            new MockResponse(file_get_contents('mock/wrong-amount-response.json'))
        );

        $mockHttpClient = new InvoiceboxHttpClient(
            $mock,
            '',
            'b37c4c689295904ed21eee5d9a48d42e',
        );

        $mockClient = new InvoiceboxClient(
            $mockHttpClient,
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
                    VatCode::VATNONE,
                    BasketItemType::COMMODITY,
                    PaymentType::FULL_PREPAYMENT,
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

            $this->fail('an exception must be thrown');
        } catch (InvalidArgument $exception) {
            $this->assertNotNull($exception);
            $this->assertEquals('wrong_total_amount', $exception->getMessage());
        }

    }
}
