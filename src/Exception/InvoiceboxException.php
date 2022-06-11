<?php

namespace Invoicebox\Sdk\Exception;

use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Exception;

abstract class InvoiceboxException extends Exception implements HttpExceptionInterface
{
    protected $message = 'Error';
    protected int $statusCode = 400;
    protected ?FieldErrorCollection $fieldErrorCollection = null;

    public function __construct(
        string $message = null,
        ?FieldErrorCollection $fieldErrorCollection = null
    ) {
        parent::__construct($message ?? $this->message);

        $this->fieldErrorCollection = $fieldErrorCollection;
    }

    public function getFieldErrorCollection(): ?FieldErrorCollection
    {
        return $this->fieldErrorCollection;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getHeaders(): array
    {
        return [];
    }
}
