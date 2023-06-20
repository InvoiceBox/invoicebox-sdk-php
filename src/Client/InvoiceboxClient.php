<?php

namespace Invoicebox\Sdk\Client;

use Invoicebox\Sdk\DTO\CheckAuth\CheckAuthResponse;
use Invoicebox\Sdk\DTO\Filter\Filter;
use Invoicebox\Sdk\DTO\Order\CreateOrderRequest;
use Invoicebox\Sdk\DTO\Order\CreateOrderResponse;
use Invoicebox\Sdk\DTO\Order\UpdateOrderRequest;
use Invoicebox\Sdk\Exception\ExceptionFactory;
use Invoicebox\Sdk\Exception\InvalidArgument;
use Symfony\Component\HttpClient\Exception\JsonException;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class InvoiceboxClient
{
    private HttpClientInterface $client;

    private const DEFAULT_API_URL = 'https://api.invoicebox.ru';

    private string $authKey;

    private string $apiUrl;

    public function __construct(
        HttpClientInterface $client,
        string $authKey,
        ?string $apiUrl = null
    ) {
        $this->client = $client;
        $this->apiUrl = $apiUrl ?? self::DEFAULT_API_URL;
        $this->authKey = $authKey;
    }

    public function checkAuth(): CheckAuthResponse
    {
        $responseData = $this->doGetRequest('/v3/security/api/auth/auth');

        return CheckAuthResponse::fromArray($responseData);
    }

    public function createOrder(
        CreateOrderRequest $createOrderRequest
    ): CreateOrderResponse {
        $responseData = $this->doPostRequest('/v3/billing/api/order/order', $createOrderRequest->toArray());

        return CreateOrderResponse::fromArray($responseData);
    }

    public function updateOrder(
        string $uuid,
        UpdateOrderRequest $updateOrderRequest
    ): CreateOrderResponse {
        $responseData = $this->doPutRequest("/v3/billing/api/order/order/$uuid", $updateOrderRequest->toArray());

        return CreateOrderResponse::fromArray($responseData);
    }

    public function deleteOrder(string $uuid): CreateOrderResponse
    {
        $responseData = $this->doDeleteRequest("/v3/billing/api/order/order/$uuid");

        return CreateOrderResponse::fromArray($responseData);
    }

    /**
     * @return CreateOrderResponse[]
     */
    public function findOrderByFilter(Filter $filter)
    {
        $responseRawData = $this->doGetRequest(
            '/v3/filter/api/order/order',
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
            $this->apiUrl . $url,
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
            $this->apiUrl . $url,
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
            'POST',
            $this->apiUrl . $url,
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
            $this->apiUrl . $url,
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

    private function prepareResponse(ResponseInterface $response): array
    {
        try {
            $responseData = $response->toArray(false);
        } catch (JsonException $e) {
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
