<?php

namespace Invoicebox\Sdk\Exception;

class SerializationException extends GateException
{
    protected $message = 'Error while serializing data';

    protected int $statusCode = 422;
}
