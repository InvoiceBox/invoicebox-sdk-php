<?php

namespace Invoicebox\Sdk\DTO\CheckAuth;

class CheckAuthResponse
{
    private string $userId;

    public function getUserId(): string
    {
        return $this->userId;
    }

    public static function fromArray(array $responseData): CheckAuthResponse
    {
        $checkAuthResponse = new self();
        $checkAuthResponse->userId = $responseData['userId'];

        return $checkAuthResponse;
    }
}
