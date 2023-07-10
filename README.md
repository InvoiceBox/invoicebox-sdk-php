PHP SDK является готовой библиотекой для серверного взаимодействия с API Инвойсбокс. Библиотека поддерживает
все необходимые методы API для организации приёма платежей.

## Требования

PHP 7.4+ (или более поздняя версия)

## Установка с помощью Composer

1. Установите Composer, менеджер пакетов
2. В консоле выполните следующую команду:

```
composer require invoicebox/sdk-php
```

Пропишите в файле composer.json вашего проекта:

1. Добавьте строку "invoicebox/sdk-php": "^1.0" в список зависимостей вашего проекта в файле composer.json

```
   "require": {
        "php": ">=7.4",
        "invoicebox/sdk-php": "^1.0"
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

```php
use Invoicebox\Sdk\Client\InvoiceboxClient;
use Invoicebox\Sdk\DTO\Enum\BasketItemType;
use Invoicebox\Sdk\DTO\Enum\PaymentType;
use Invoicebox\Sdk\DTO\Enum\VatCode;
use Invoicebox\Sdk\DTO\Order\BasketItem;
use Invoicebox\Sdk\DTO\Order\CreateOrderRequest;
use Invoicebox\Sdk\DTO\Order\LegalCustomer;
use Symfony\Component\HttpClient\HttpClient;

/**
 * Создание клиента, с ключем авторизации
 */
$httpClient = HttpClient::create();

$ibClient = new InvoiceboxClient(
    $httpClient,
    'b37c4c689295904ed21eee5d9a48d42e',
);

/**
 * Проверка авторизации (необязательный шаг, для тестирования наличия доступа)
 */
$result = $ibClient->checkAuth();
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

/* Если плательщик - юридическое лицо */
$customer = new LegalCustomer(
    'ООО "Ромашка"',
    '79111231212',
    'my@romashkacompany.dd',
    '2323232323', /* ИНН */
    'г. Ижевск, ул. Сверидова, д.1, оф. 323'
);

/* Если плательщик - физическое лицо */
$customer = new PrivateCustomer(
    'Иванов Иван Иванович',
    '79111231212',
    'ivanov@ivanivanovich.dd'
);

$request = new CreateOrderRequest(
    'Проездной билет',
    'ffffffff-ffff-ffff-ffff-ffffffffffff', /* Идентификатор магазина */
    123, /* Идентификатор заказа */
    2790.67, /* Стоимость заказа итого */
    0.0, /* Сумма налога в заказе итого */
    'RUB', /* Идентификатор валюты заказа */
    new \DateTime('tomorrow'), /* Срок оплаты (жизни) заказа */
    [$basketItems],
    $customer
);

/**
 * Создание заказа
 */
$result = $ibClient->createOrder($request);

if ($result->getPaymentUrl()) {
    echo sprintf('Заказ успешно создан - ссылка на оплату - %s', $result->getPaymentUrl());
}

/* Redirect to: $orderResponseData->getPaymentUrl() */
```
