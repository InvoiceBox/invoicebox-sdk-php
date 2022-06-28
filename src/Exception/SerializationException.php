<?php

namespace Invoicebox\Sdk\Exception;

use Exception;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class SerializationException extends GateException
{
    protected $message = 'Error while serializing data';
    protected int $statusCode = 422;
}
