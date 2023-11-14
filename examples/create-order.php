<?php

use Invoicebox\Sdk\Client\InvoiceboxClient;
use Invoicebox\Sdk\DTO\Enum\BasketItemType;
use Invoicebox\Sdk\DTO\Enum\PaymentType;
use Invoicebox\Sdk\DTO\Enum\VatCode;
use Invoicebox\Sdk\DTO\Order\BasketItem;
use Invoicebox\Sdk\DTO\Order\CreateOrderRequest;
use Invoicebox\Sdk\DTO\Order\LegalCustomer;
use Symfony\Component\HttpClient\HttpClient;

require __DIR__ . '/../vendor/autoload.php';


/**
 * Создание клиента, с ключем авторизации
 */

//$client = new InvoiceboxClient(
//    'b37c4c689295904ed21eee5d9a48d42e',
//    'v3',
//    null,
//    null,
//);

$client = new InvoiceboxClient(
    '78436-API:0884805c7d5345818f4e5169d4ecbb2bce056e32f0081533bce9d57f399c91b1',
    'l3',
    null,
    null,
);


/**
 * Проверка авторизации (необязательный шаг, для тестирования наличия доступа)
 */
$result = $client->checkAuth();

if ($result->getUserId()) {
    echo "Успешная авторизация \n";
}

/**
 * Создание позиций заказа, заполнение данных клиент и заполнение данных заказа
 */


$basketItems[] = new BasketItem(
    '12312',
    'Black Edition',
    'шт.',
    '796',
    1.0,
    1000.00,
    1000,
    1000.00,
    0,
    VatCode::VATNONE,
    BasketItemType::COMMODITY,
    PaymentType::FULL_PREPAYMENT,
    new \DateTime('2023-10-30')
);


$customer = new LegalCustomer(
    'OOO TES',
    '78121111111',
    'test@test.test',
    '7804445210',
    '123321, Колотушкина, 1, 1',
    '504701001',
);

$request = new CreateOrderRequest(
    'Проездной билет',
    '2802d45d-2557-4657-96c5-7cf50853c438',
    strval(random_int(1,1000)),
    1000.00,
    0,
    'RUB',
    new \DateTime('tomorrow'),
    $basketItems,
    $customer
);

/**
 * Создание заказа
 */
$result = $client->createOrder($request);

if ($result->getPaymentUrl()) {
    echo sprintf('Заказ успешно создан - ссылка на оплату - %s', $result->getPaymentUrl());
}
