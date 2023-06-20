<?php

namespace Invoicebox\Sdk\DTO\Order;

class PrivateCustomer
{
    protected string $type = 'private';

    protected ?string $name = null;

    protected ?string $phone = null;

    protected ?string $email = null;

    public function __construct(
        ?string $name = null,
        ?string $phone = null,
        ?string $email = null
    ) {
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function toArray(): array
    {
        return array_filter([
            'type' => $this->type,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
        ]);
    }

    public static function fromArray(array $data): PrivateCustomer
    {
        return new self(
            $data['name'],
            $data['phone'],
            $data['email']
        );
    }
}
