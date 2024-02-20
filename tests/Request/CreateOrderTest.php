<?php

namespace Invoicebox\Sdk\Tests\Request;

use Invoicebox\Sdk\DTO\Enum\BasketItemType;
use Invoicebox\Sdk\DTO\Enum\PaymentType;
use Invoicebox\Sdk\DTO\Enum\VatCode;
use Invoicebox\Sdk\DTO\Order\BasketItem;
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

        $basketItems = new BasketItem(
            '0123456789',
            'Black Edition',
            'шт.',
            '796',
            1.0,
            2790.67,
            2790.67,
            2790.67,
            0.0,
            VatCode::VATNONE,
            BasketItemType::COMMODITY,
            PaymentType::FULL_PREPAYMENT,
        );
        $customer = new LegalCustomer(
            'OOO TEST',
            '78121111111',
            'test@test.test',
            '123321',
            '123321, Колотушкина, 1, 1',
            '504701001',
        );
        $request = new CreateOrderRequest(
            'Проездной билет',
            'ffffffff-ffff-ffff-ffff-ffffffffffff',
            '1',
            2790.67,
            0.0,
            'RUB',
            new \DateTime('yesterday'),
            [$basketItems],
            $customer
        );

        $response = $mockClient->createOrder($request);

        $this->assertNotNull($response);
        $this->assertEquals('017f038f-c78b-736d-dc00-8bce30bd0f9f', $response->getId());
    }

    /**
     * @test
     */
    public function createInvoiceboxOrderWrongAmount()
    {
        $mockClient = $this->createMockClient('mock/wrong-amount-response.json');

        $basketItems = new BasketItem(
            '0123456789',
            'Black Edition',
            'шт.',
            '796',
            1.0,
            2790.67,
            2790.67,
            2790.67,
            0.0,
            VatCode::VATNONE,
            BasketItemType::COMMODITY,
            PaymentType::FULL_PREPAYMENT,

        );
        $customer = new LegalCustomer(
            'OOO TEST',
            '78121111111',
            'test@test.test',
            '123321',
            '123321, Колотушкина, 1, 1',
            '504701001',
        );
        $request = new CreateOrderRequest(
            'Проездной билет',
            'ffffffff-ffff-ffff-ffff-ffffffffffff',
            '1',
            2790.67,
            0.0,
            'RUB',
            new \DateTime('yesterday'),
            [$basketItems],
            $customer,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            321
        );

        $this->expectException(InvalidArgument::class);
        $this->expectExceptionMessage('Calculation Error');
        $mockClient->createOrder($request);
    }
}
