PHP SDK является готовой библиотекой для серверного взаимодействия с API Инвойсбокс. Библиотека поддерживает
все необходимые методы API для организации приёма платежей.

## Требования

PHP 7.4+ (или более поздняя версия)

## Установка с помощью Composer

1. Установите Composer, менеджер пакетов
2. В консоле выполните следующую команду:

```
composer require invoicebox/invoicebox-sdk-php
```

Пропишите в файле composer.json вашего проекта:

1. Добавьте строку "invoicebox/invoicebox-sdk-php": "^1.0" в список зависимостей вашего проекта в файле composer.json

```
   "require": {
        "php": ">=7.4",
        "invoicebox/invoicebox-sdk-php": "^1.0"
```

2. Обновите зависимости вашего проекта. В консоле, в папке с файлом composer.json выполните следующую команду:

```
composer update
```

3. Подготовьте код своего проекта, чтобы активировать автоматическую загрузку зависимостей:
 
```
require __DIR__ . '/vendor/autoload.php';
```

## Установка SDK вручную

1. Скачайте архив [Инвойсбокс PHP SDK](https://github.com/InvoiceBox/invoicebox-sdk-php) и распакуйте его в необходимую папку вашего проекта.

2. Подготовьте код своего проекта, чтобы активировать автоматическую загрузку зависимостей:
 
```
require __DIR__ . '/vendor/autoload.php';
```

## Пример использования

```
$httpClient = new HttpClient();

$ibClient = new InvoiceboxClient(
    $httpClient,
    'b37c4c689295904ed21eee5d9a48d42e', /* Токен */
    'ffffffff-ffff-ffff-ffff-ffffffffffff' /* Идентификатор магазина */
);

$createOrderRequest = new CreateOrderRequest(
    'Оплата заказа №123',
    '123', /* Идентификатор заказа */
    100.88, /* Стоимость заказа итого */
    0.00, /* Сумма налога в заказе итого */
    'RUB', /* Идентификатор валюты заказа */
    (new DateTime())->modify('+1 day') /* Срок оплаты (жизни) заказа */
);

// $createOrderRequest->setReturnUrl($returnUrl); /* Ссылка возврата в магазин */
// $createOrderRequest->setSuccessUrl($returnUrl); /* Ссылка возврата в магазин после успешной оплаты */
// $createOrderRequest->setFailUrl($returnUrl);  /* Ссылка возврата в магазин при ошибке оплаты */
// $createOrderRequest->setNotificationUrl('https://www.example.com/api/integration/invoicebox-v3');  /* Ссылка уведомления магазина об оплате через callback */

$invoiceboxCartItem = new CartItem(
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
);
$createOrderRequest->addCartItem($invoiceboxCartItem);

/* Если плательщик - юридическое лицо */
//    $customer = new LegalCustomer(
//        'ООО "Ромашка"',
//        '79111231212',
//        'my@romashkacompany.dd',
//        '2323232323', /* ИНН */
//        'г. Ижевск, ул. Сверидова, д.1, оф. 323'
//    );

/* Если плательщик - физическое лицо */
//    $customer = new PrivateCustomer(
//        'Иванов Иван Иванович',
//        '79111231212',
//        'ivanov@ivanivanovich.dd'
//    );

$createOrderRequest->setCustomer($customer);

$orderResponseData = $ibClient->createOrder($createOrderRequest);

/* Redirect to: $orderResponseData->getPaymentUrl() */

```
