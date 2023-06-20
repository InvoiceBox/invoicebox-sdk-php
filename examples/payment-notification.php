<?php

use Invoicebox\Sdk\DTO\NotificationResult;
use Invoicebox\Sdk\SignValidator;

require __DIR__ . '/../vendor/autoload.php';

/**
 * После оплаты заказа от Invoicebox придет уведомление о подтверждении оплаты в json формате
 */
$notificationJson = '{"id":"0188d934-85f8-f872-2ac6-ad202d71b985","description":"Проездной билет","currencyId":"RUB","amount":2790.67,"vatAmount":0,"basketItems":[{"sku":"0123456789","name":"Black Edition","measure":"шт","measureCode":"796","quantity":1,"amount":2790.67,"amountWoVat":2790.67,"totalAmount":2790.67,"totalVatAmount":0,"vatCode":"VATNONE","type":"commodity","paymentType":"full_prepayment"}],"orderContainerId":"0188d934-85bd-2e43-9057-53275f15a1e2","merchantId":"ffffffff-ffff-ffff-ffff-ffffffffffff","status":"success","subtype":"order","createdAt":"2023-06-20T14:27:58+00:00","merchantOrderId":"55626","merchantOrderIdVisible":"55626","expirationDate":"2023-06-20T21:00:00+00:00","fileIds":[],"paymentUrl":"https:\/\/pay.invoicebox.ru\/order\/0188d934-85bd-2e43-9057-53275f15a1e2","customer":{"type":"legal","name":"OOO TEST","phone":"78121111111","email":"test@test.test","vatNumber":"7804445210","countryId":"RUS","registrationAddress":"123321, Колотушкина, 1, 1"},"languageId":"ru","processable":true}';

/**
 * Подпись придет в заголовке 'X-Signature' http запроса
 */
$signature = '4731e2fb446ba519fd9d8798a1a0873f073189e8';

/**
 * Ключ подписи находится в настройках интеграции в личном кабинете магазина
 */
$secretKey = 'test';

/**
 * Уведомление нужно проверить на достоверноесть, сравнив подпись запроса
 */
$validator = new SignValidator();

$result = $validator->validate($notificationJson, $secretKey, $signature);

/**
 * Результатом проверки будет экземпляр класса Invoicebox\Sdk\DTO\Order\OrderNotification
 */
if ($result->getStatus() == NotificationResult::SUCCESS) {
    echo 'Успешная оплата';
}
