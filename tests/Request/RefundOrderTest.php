<?php

namespace Invoicebox\Sdk\Tests\Request;

use Invoicebox\Sdk\DTO\Enum\BasketItemType;
use Invoicebox\Sdk\DTO\Enum\PaymentType;
use Invoicebox\Sdk\DTO\Enum\VatCode;
use Invoicebox\Sdk\DTO\Order\BasketItem;
use Invoicebox\Sdk\DTO\Order\CreateRefundOrderRequest;
use Invoicebox\Sdk\Tests\InvoiceboxTestCase;

class RefundOrderTest extends InvoiceboxTestCase
{
    /**
     * @test
     */
    public function getBasketItemsRefundableOrders()
    {
        $mockClient = $this->createMockClient('mock/success-get-basket-response.json');

        $response = $mockClient->findAvailableRefundBasketItems('017f038f-c78b-736d-dc00-8bce30bd0f9f');


        $this->assertNotNull($response->getBasketItems());
    }

    /**
     * @test
     */
    public function createRefundOrder()
    {
        $mockClient = $this->createMockClient('mock/success-create-refund-order.json');

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

        $refundRequest = new CreateRefundOrderRequest(
            '017f038f-c78b-736d-dc00-8bce30bd0f9f',
            '017f038f-c78b-736d-dc00-8bce30bd0f9f',
            2790.67,
            0,
            [$basketItems],
            "Проездной билет"
        );

        $response = $mockClient->createRefundOrder($refundRequest);

        $this->assertEquals('01771534-196a-1105-839a-82422289d6d9', $response->getParentId());
        $this->assertNotEmpty($response->getBasketItems());

    }
}
