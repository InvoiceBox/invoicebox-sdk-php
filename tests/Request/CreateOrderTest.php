<?php

namespace Invoicebox\Sdk\Tests\Request;

use Invoicebox\Sdk\DTO\Enum\BasketItemType;
use Invoicebox\Sdk\DTO\Enum\PaymentType;
use Invoicebox\Sdk\DTO\Enum\VatCode;
use Invoicebox\Sdk\DTO\Order\CartItem;
use Invoicebox\Sdk\DTO\Order\CreateOrderRequest;
use Invoicebox\Sdk\DTO\Order\LegalCustomer;
use Invoicebox\Sdk\Exception\InvalidArgument;
use Invoicebox\Sdk\Tests\InvoiceboxTestCase;

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
        $mockClient = $this->createMockClient('mock/wrong-amount-response.json');

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
