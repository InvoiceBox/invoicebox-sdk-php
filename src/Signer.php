<?php

namespace Invoicebox\Sdk;

use Exception;

class Signer
{
    private string $method;

    private string $algo;

    public function __construct(string $method, string $algo)
    {
        switch ($method) {
            case 'hash_hmac':
                $this->method = 'hash_hmac';
                break;
            case 'hash':
                $this->method = 'hash';
                break;
            default:
                throw new Exception(sprintf('Not support sign method %s', $method));
        }

        if (in_array($algo, hash_algos())) {
            $this->algo = $algo;
        } else {
            throw new Exception(sprintf('Not support sign algo %s', $algo));
        }
    }

    public function getSign(string $message, string $key): string
    {
        $method = $this->method;

        return $method($this->algo, $message, $key);
    }
}
