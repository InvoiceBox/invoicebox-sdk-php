<?php

namespace Invoicebox\Sdk\Exception;

class ExceptionFactory
{
    public static function create(array $array): GateException
    {
        if (!isset($array['code'])) {
            return new InternalException('Internal server error');
        }

        switch ($array['code']) {
            case 'unauthorized':
                return new Unauthorized($array['message']);
        }

        return new InvalidArgument($array['message']);
    }
}
