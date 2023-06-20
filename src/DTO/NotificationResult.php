<?php

namespace Invoicebox\Sdk\DTO;

class NotificationResult
{
    public const ORDER_NOT_FOUND = 'order_not_found';

    public const SIGNATURE_ERROR = 'signature_error';

    public const ORDER_WRONG_AMOUNT = 'order_wrong_amount';

    public const ORDER_WRONG_STATUS = 'order_wrong_status';

    public const OUT_OF_SERVICE = 'out_of_service';

    public const ORDER_ALREADY_PAID = 'order_already_paid';

    public const SUCCESS = 'success';

    private string $status;

    private ?string $code = null;

    private ?string $message = null;

    public function __construct(string $type)
    {
        switch ($type) {
            case self::ORDER_NOT_FOUND:
                $this->setStatus('error');
                $this->setCode(self::ORDER_NOT_FOUND);
                $this->setMessage('Заказ не найден в учётной системе Магазина');
                break;
            case self::SIGNATURE_ERROR:
                $this->setStatus('error');
                $this->setCode(self::SIGNATURE_ERROR);
                $this->setMessage('Ошибка проверки подписи запроса');
                break;
            case self::ORDER_WRONG_AMOUNT:
                $this->setStatus('error');
                $this->setCode(self::ORDER_WRONG_AMOUNT);
                $this->setMessage('Сумма заказа в Магазине не соответствует сумме заказа в уведомлении');
                break;
            case self::OUT_OF_SERVICE:
                $this->setStatus('error');
                $this->setCode(self::OUT_OF_SERVICE);
                $this->setMessage('Внутрянняя ошибка');
                break;
            case self::ORDER_ALREADY_PAID:
                $this->setStatus('error');
                $this->setCode(self::ORDER_ALREADY_PAID);
                $this->setMessage('Заказ уже оплачен другим инструментом оплаты');
                break;
            case self::ORDER_WRONG_STATUS:
                $this->setStatus('error');
                $this->setCode(self::ORDER_WRONG_STATUS);
                $this->setMessage('Неподдерживаемый статус');
                break;
            case self::SUCCESS:
                $this->setStatus('success');
                break;
        }
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function toArray(): array
    {
        $data = [
            'status' => $this->status,
            'code' => $this->code,
            'message' => $this->message,
        ];

        return array_filter($data);
    }
}
