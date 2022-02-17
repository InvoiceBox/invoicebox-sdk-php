<?php

namespace Invoicebox\Src\Tests\Unit;

use Invoicebox\Sdk\Client\InvoiceboxClient;
use Invoicebox\Sdk\DTO\CreateOrderRequest\CartItem;
use Invoicebox\Sdk\DTO\CreateOrderRequest\CreateOrderRequest;
use Invoicebox\Sdk\DTO\CreateOrderRequest\Customer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\HttpClient;
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
            new MockResponse(
                '{
                  "data": {
                    "id": "017f038f-c78b-736d-dc00-8bce30bd0f9f",
                    "description": "Проездной билет",
                    "currencyId": "RUB",
                    "amount": 2790.67,
                    "vatAmount": 0,
                    "basketItems": [
                      {
                        "sku": "0123456789",
                        "name": "Black Edition",
                        "measure": "шт",
                        "measureCode": "796",
                        "quantity": 1,
                        "amount": 2790.67,
                        "amountWoVat": 2790.67,
                        "totalAmount": 2790.67,
                        "totalVatAmount": 0,
                        "vatCode": "VATNONE",
                        "type": "commodity",
                        "paymentType": "full_prepayment"
                      }
                    ],
                    "orderContainerId": "017f038f-c751-e9e7-f580-d0685b4b74d9",
                    "merchantId": "ffffffff-ffff-ffff-ffff-ffffffffffff",
                    "status": "created",
                    "subtype": "order",
                    "processingStatus": "",
                    "createdAt": "2022-02-16T17:23:48+00:00",
                    "merchantOrderId": "1",
                    "expirationDate": "2023-07-02T00:00:00+00:00",
                    "fileIds": [],
                    "paymentUrl": "https:\/\/payment.dev.invbox.ru\/order\/017f038f-c751-e9e7-f580-d0685b4b74d9",
                    "customer": {
                      "type": "private",
                      "name": "OOO TEST",
                      "phone": "78121111111",
                      "email": "test@test.test",
                      "vatNumber": "123321",
                      "registrationAddress": "123321, Колотушкина, 1, 1"
                    },
                    "languageId": "ru",
                    "processable": true
                  },
                  "extendedData": []
                }'
            )
        );
        $response = $mock->request(
            'POST',
            'https://api.stage.invbox.ru/v3/billing/api/order/order'
        );
//        $response = $mock->createOrder(
//            new CreateOrderRequest(
//                'Проездной билет',
//                '1',
//                2790.67,
//                0.0,
//                'RUB',
//                new \DateTime('yesterday'),
//                [
//                    new CartItem(
//                        '0123456789',
//                        'Black Edition',
//                        'шт.',
//                        '796',
//                        1.0,
//                        2790.67,
//                        2790.67,
//                        0.0,
//                        'VATNONE',
//                        'commodity',
//                        'full_prepayment',
//                        2790.67
//                    )
//                ],
//                new Customer(
//                    'private',
//                    'OOO TEST',
//                    '78121111111',
//                    'test@test.test',
//                    '123321',
//                    '123321, Колотушкина, 1, 1'
//                ),
//            )
//        );
        $this->assertNotNull($response);
    }
}
