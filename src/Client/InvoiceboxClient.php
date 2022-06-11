<?php

namespace Invoicebox\Sdk\Client;

use Invoicebox\Sdk\DTO\CheckAuth\CheckAuthResponse;
use Invoicebox\Sdk\DTO\Filter\Filter;
use Invoicebox\Sdk\DTO\Order\CreateOrderRequest;
use Invoicebox\Sdk\DTO\Order\CreateOrderResponse;
use Invoicebox\Sdk\DTO\Order\UpdateOrderRequest;
use Invoicebox\Sdk\Exception\InvalidArgument;

class InvoiceboxClient
{
    private InvoiceboxHttpClient $client;
    private ?string $defaultMerchantId;

    public function __construct(
        InvoiceboxHttpClient $client,
        ?string $defaultMerchantId = null
    ) {
        $this->client = $client;
        $this->defaultMerchantId = $defaultMerchantId;
    }

    public function checkAuth(): CheckAuthResponse
    {
        $responseData = $this->client->doGetRequest('/v3/security/api/auth/auth');

        return CheckAuthResponse::fromArray($responseData);
    }

    public function createOrder(
        CreateOrderRequest $createOrderRequest,
        string $merchantId = null
    ): CreateOrderResponse {
        if ($merchantId) {
            $createOrderRequest->setMerchantId($merchantId);
        } elseif ($this->defaultMerchantId !== null) {
            $createOrderRequest->setMerchantId($this->defaultMerchantId);
        } else {
            throw new InvalidArgument('Empty merchant id');
        }

        $responseData = $this->client->doPostRequest('/v3/billing/api/order/order', $createOrderRequest->toArray());

        return CreateOrderResponse::fromArray($responseData);
    }

    public function updateOrder(
        string $uuid,
        UpdateOrderRequest $updateOrderRequest
    ): CreateOrderResponse {
        $responseData = $this->client->doPutRequest("/v3/billing/api/order/order/$uuid", $updateOrderRequest->toArray());

        return CreateOrderResponse::fromArray($responseData);
    }

    public function deleteOrder(string $uuid): CreateOrderResponse
    {
        $responseData = $this->client->doDeleteRequest("/v3/billing/api/order/order/$uuid");

        return CreateOrderResponse::fromArray($responseData);
    }

    /**
     * @return CreateOrderResponse[]
     */
    public function findOrderByFilter(Filter $filter)
    {
        $responseRawData = $this->client->doGetRequest(
            '/v3/filter/api/order/order',
            $filter->getQuery()
        );

        foreach ($responseRawData as $orderArray) {
            $responseData[] = CreateOrderResponse::fromArray($orderArray);
        }

        return $responseData;
    }
}
