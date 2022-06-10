<?php

namespace Invoicebox\Sdk\Client;

use Invoicebox\Sdk\DTO\CreateOrderRequest\CreateOrderRequest;
use Invoicebox\Sdk\DTO\CreateOrderResponse\CreateOrderResponse;
use Invoicebox\Sdk\DTO\CreateOrderResponse\CreateOrderResponseData;
use Invoicebox\Sdk\DTO\Filter\Filter;
use Invoicebox\Sdk\DTO\UpdateOrderRequest;
use Invoicebox\Sdk\Exception\InvalidArgument;
use Invoicebox\Sdk\Exception\SerializationException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class InvoiceboxClient
{
    private HttpClientInterface $client;
    private string $authKey;
    private string $apiUrl;
    private ?string $defaultMerchantId;

    public function __construct(
        HttpClientInterface $client,
        string $apiUrl,
        string $authKey,
        ?string $defaultMerchantId = null
    ) {
        $this->client = $client;
        $this->apiUrl = $apiUrl;
        $this->authKey = $authKey;
        $this->defaultMerchantId = $defaultMerchantId;
    }

    private function doPostRequest(string $url, array $body)
    {
        $response = $this->client->request(
            'POST',
            $this->apiUrl . $url,
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->authKey,
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ],
                'json' => $body
            ]
        );

        return $response->getContent(false);
    }

    private function doGetRequest(string $url, array $query = [])
    {
        $response = $this->client->request(
            'GET',
            $this->apiUrl . $url,
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->authKey,
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ],
                'query' => $query
            ]
        );

        return $response->getContent(false);
    }

    private function doPutRequest(string $url, array $body)
    {
        $response = $this->client->request(
            'POST',
            $this->apiUrl . $url,
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->authKey,
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ],
                'json' => $body
            ]
        );

        return $response->getContent(false);
    }

    private function doDeleteRequest(string $url, array $query = [])
    {
        $response = $this->client->request(
            'DELETE',
            $this->apiUrl . $url,
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->authKey,
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ],
                'query' => $query
            ]
        );

        return $response->getContent(false);
    }

    public function createOrder(
        CreateOrderRequest $createOrderRequest,
        string $merchantId = null
    ): CreateOrderResponseData {
        if ($merchantId) {
            $createOrderRequest->setMerchantId($merchantId);
        } elseif ($this->defaultMerchantId !== null) {
            $createOrderRequest->setMerchantId($this->defaultMerchantId);
        } else {
            throw new InvalidArgument('Empty merchant id');
        }

        $response = $this->doPostRequest('/v3/billing/api/order/order', $createOrderRequest->toArray());

        $responseData = new CreateOrderResponse($this->serialize($response));

        return $responseData->getData();
    }

    public function updateOrder(
        string $uuid,
        UpdateOrderRequest $updateOrderRequest
    ): CreateOrderResponseData
    {
        $response = $this->doPutRequest("/v3/billing/api/order/order/$uuid", $updateOrderRequest->toArray());

        $responseData = new CreateOrderResponse($this->serialize($response));

        return $responseData->getData();
    }

    public function deleteOrder(string $uuid): CreateOrderResponseData
    {
        $response = $this->doDeleteRequest("/v3/billing/api/order/order/$uuid");

        $responseData = new CreateOrderResponse($this->serialize($response));

        return $responseData->getData();
    }

    /**
     * @return CreateOrderResponseData[]
     */
    public function findOrderByFilter(Filter $filter) {
        $response = $this->doGetRequest(
            '/v3/filter/api/order/order',
            $filter->getQuery() ?? []
        );

        $responseData = [];

        $responseArray = $this->serialize($response);

        foreach ($responseArray['data'] as $orderDataArray) {
            $responseData[] = CreateOrderResponseData::fromArray($orderDataArray);
        }

        return $responseData;
    }

    private function serialize(string $data): array
    {
        try {
            return json_decode($data, true);
        } catch (\Exception $exception) {
            throw new SerializationException();
        }
    }
}
