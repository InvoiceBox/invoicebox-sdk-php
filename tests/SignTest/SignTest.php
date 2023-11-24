<?php

namespace Invoicebox\Sdk\Tests\SignTest;

use Invoicebox\Sdk\DTO\Enum\BasketItemType;
use Invoicebox\Sdk\DTO\Enum\PaymentType;
use Invoicebox\Sdk\DTO\Enum\VatCode;
use Invoicebox\Sdk\DTO\NotificationResult;
use Invoicebox\Sdk\DTO\Order\BasketItem;
use Invoicebox\Sdk\DTO\Order\CreateOrderRequest;
use Invoicebox\Sdk\DTO\Order\CreateOrderResponse;
use Invoicebox\Sdk\DTO\Order\LegalCustomer;
use Invoicebox\Sdk\SignValidator;
use Invoicebox\Sdk\Tests\InvoiceboxTestCase;

class SignTest extends InvoiceboxTestCase
{
    private const SECRET_KEY = 'testSecretKey';
    /**
     * @test
     */
    public function signTest(): void
    {
        $validator = new SignValidator();
        $order = $this->getOrder();
        $orderId = $order->getId();
        $orderNotification = $order->toArray();
        $status = NotificationResult::SUCCESS;
        $orderNotification['status'] = $status;
        $orderNotification['id'] = $orderId;
        $orderNotification['createdAt'] = (new \DateTime())->format('Y-m-d');

        $signature = hash_hmac('sha1', json_encode($orderNotification), self::SECRET_KEY);

        $result = $validator->validate(json_encode($orderNotification), self::SECRET_KEY, $signature);

        self::assertEquals($order->getMerchantOrderId(), $result->getMerchantOrderId());
        self::assertEquals($status, $result->getStatus());
    }

    private function getOrder(): CreateOrderResponse
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

        return $mockClient->createOrder($request);
    }
}
