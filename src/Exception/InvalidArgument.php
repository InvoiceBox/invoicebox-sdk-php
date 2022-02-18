<?php

namespace Invoicebox\Sdk\Exception;

class InvalidArgument extends InvoiceboxException
{
    protected int $statusCode = 422;
}
