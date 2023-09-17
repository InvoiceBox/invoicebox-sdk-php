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


$client = new InvoiceboxClient(
    'b37c4c689295904ed21eee5d9a48d42e',
    null,
    null,
    HttpClient::create(),
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
    '7804445210',
    '123321, Колотушкина, 1, 1'
);
$request = new CreateOrderRequest(
    'Проездной билет',
    'ffffffff-ffff-ffff-ffff-ffffffffffff',
    random_int(1, 999999),
    2790.67,
    0.0,
    'RUB',
    new \DateTime('tomorrow'),
    [$basketItems],
    $customer
);

/**
 * Создание заказа
 */
$result = $client->createOrder($request);

if ($result->getPaymentUrl()) {
    echo sprintf('Заказ успешно создан - ссылка на оплату - %s', $result->getPaymentUrl());
}
