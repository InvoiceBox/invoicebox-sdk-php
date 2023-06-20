<?php

namespace Invoicebox\Sdk;

use Invoicebox\Sdk\DTO\Order\OrderNotification;
use Invoicebox\Sdk\Exception\SignError;

class SignValidator
{
    public const SIGNATURE_HEADER = 'X-Signature';

    private const DEFAULT_SING_METHOD = 'hash_hmac';

    private const DEFAULT_SING_ALGO = 'sha1';

    public function validate(
        string $content,
        string $secretKey,
        string $signature,
        ?string $singMethod = null,
        ?string $singAlgo = null
    ): OrderNotification {
        $orderNotificationContent = json_decode($content, true);
        $orderNotification = OrderNotification::fromArray($orderNotificationContent);

        $signer = new Signer($singMethod ?? self::DEFAULT_SING_METHOD, $singAlgo ?? self::DEFAULT_SING_ALGO);
        $expectedSign = $signer->getSign($content, $secretKey);

        if ($expectedSign !== $signature) {
            throw new SignError('Order notification sign error');
        }

        return $orderNotification;
    }
}
