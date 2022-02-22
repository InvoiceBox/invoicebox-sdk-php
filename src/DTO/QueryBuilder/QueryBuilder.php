<?php

namespace Invoicebox\Sdk\DTO\QueryBuilder;

class QueryBuilder
{
    private array $query;

    public function getQuery(): array
    {
        return $this->query;
    }

    public function addEqual(string $key, string $value)
    {
        $this->query[$key] = $value;
    }
}
