<?php

namespace Invoicebox\Sdk\Client;

use Invoicebox\Sdk\DTO\CheckAuth\CheckAuthResponse;
use Invoicebox\Sdk\DTO\Filter\Filter;
use Invoicebox\Sdk\DTO\Order\CreateOrderRequest;
use Invoicebox\Sdk\DTO\Order\CreateOrderResponse;
use Invoicebox\Sdk\DTO\Order\UpdateOrderRequest;
use Invoicebox\Sdk\Exception\ExceptionFactory;
use Invoicebox\Sdk\Exception\InvalidArgument;
use Throwable;

class InvoiceboxClient
{
    /**
     * @var HttpClient
     */
    private $client;

    private const DEFAULT_API_URL = 'https://api.invoicebox.ru';

    private const DEFAULT_API_VERSION = 'v3';

    private string $authKey;

    private string $apiUrl;

    private string $apiVersion;

    public function __construct(
        HttpClient $client,
        string $authKey,
        ?string $apiUrl = null,
        ?string $apiVersion = null
    ) {
        $this->client = $client;
        $this->authKey = $authKey;
        $this->apiUrl = $apiUrl ?? self::DEFAULT_API_URL;
        $this->apiVersion = $apiVersion ?? self::DEFAULT_API_VERSION;
    }

    public function checkAuth(): CheckAuthResponse
    {
        $responseData = $this->doGetRequest("/security/api/auth/auth");
        return CheckAuthResponse::fromArray($responseData);
    }

    public function createOrder(
        CreateOrderRequest $createOrderRequest
    ): CreateOrderResponse {
        $responseData = $this->doPostRequest('/billing/api/order/order', $createOrderRequest->toArray());

        return CreateOrderResponse::fromArray($responseData);
    }

    public function updateOrder(
        string $uuid,
        UpdateOrderRequest $updateOrderRequest
    ): CreateOrderResponse {
        $responseData = $this->doPutRequest("/billing/api/order/order/$uuid", $updateOrderRequest->toArray());

        return CreateOrderResponse::fromArray($responseData);
    }

    public function deleteOrder(string $uuid): CreateOrderResponse
    {
        $responseData = $this->doDeleteRequest("/billing/api/order/order/$uuid");

        return CreateOrderResponse::fromArray($responseData);
    }

    /**
     * @return CreateOrderResponse[]
     */
    public function findOrderByFilter(Filter $filter)
    {
        $responseRawData = $this->doGetRequest(
            '/filter/api/order/order',
            $filter->getQuery()
        );

        $responseData = [];

        foreach ($responseRawData as $orderArray) {
            $responseData[] = CreateOrderResponse::fromArray($orderArray);
        }

        return $responseData;
    }

    private function doPostRequest(string $url, array $body): array
    {
        $response = $this->client->request(
            'POST',
            $this->apiUrl . '/' . $this->apiVersion . $url,
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->authKey,
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'json' => $body,
            ]
        );

        return $this->prepareResponse($response);
    }

    private function doGetRequest(string $url, array $query = []): array
    {
        $response = $this->client->request(
            'GET',
            $this->apiUrl . '/' . $this->apiVersion . $url,
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->authKey,
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'query' => $query,
            ]
        );
        return $this->prepareResponse($response);
    }

    private function doPutRequest(string $url, array $body): array
    {
        $response = $this->client->request(
            'PUT',
            $this->apiUrl . '/' . $this->apiVersion . $url,
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->authKey,
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'json' => $body,
            ]
        );

        return $this->prepareResponse($response);
    }

    private function doDeleteRequest(string $url, array $query = []): array
    {
        $response = $this->client->request(
            'DELETE',
            $this->apiUrl . '/' . $this->apiVersion . $url,
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->authKey,
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'query' => $query,
            ]
        );

        return $this->prepareResponse($response);
    }

    private function prepareResponse(HttpResponse $response): array
    {
        try {
            $responseData = $response->toArray(false);
        } catch (Throwable $e) {
            throw new InvalidArgument($e->getMessage());
        }

        if (isset($responseData['error'])) {
            throw ExceptionFactory::create($responseData['error']);
        }

        if (isset($responseData['data'])) {
            return $responseData['data'];
        }

        throw new InvalidArgument('wrong_response');
    }
}
