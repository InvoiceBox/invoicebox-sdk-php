<?php

namespace Invoicebox\Sdk\DTO\Filter;

class Filter
{
    private array $query = [];

    public function getQuery(): array
    {
        return $this->query;
    }

    public function addEqual(string $key, string $value): void
    {
        $this->query[$key][] = $value;
    }

    public function addInCondition(string $key, array $values): void
    {
        foreach ($values as $value) {
            $query[$key . '[]'] = $value;
        }
    }
}
