<?php

namespace Invoicebox\Sdk\Client;

use Invoicebox\Sdk\DTO\CreateOrderRequest\CreateOrderRequest;
use Invoicebox\Sdk\DTO\CreateOrderResponse\InvoiceboxOrderCreateResponse;
use Invoicebox\Sdk\DTO\CreateOrderResponse\InvoiceboxOrderData;
use Invoicebox\Sdk\Exception\InvalidArgument;
use Invoicebox\Sdk\JsonSerializer;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class InvoiceboxClient
{
    private const BASE_URL = 'https://api.stage.invbox.ru/';

    private HttpClientInterface $client;
    private string $authKey;
    private string $merchantId;
    private JsonSerializer $serializer;

    public function __construct(
        HttpClientInterface $client,
        string $authKey,
        string $merchantId,
        JsonSerializer $serializer
    ) {
        $this->client = $client;
        $this->authKey = $authKey;
        $this->merchantId = $merchantId;
        $this->serializer = $serializer;
    }

    private function doPostRequest(string $url, string $jsonBody)
    {
        $response = $this->client->request(
            'POST',
            self::BASE_URL . $url,
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->authKey,
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ],
                'body' => $jsonBody,
            ]
        );
        return $response->getContent();
    }

    private function doGetRequest(string $url, array $query = [])
    {
        $response = $this->client->request(
            'GET',
            self::BASE_URL . $url,
            [
                'query' => $query
            ]
        );

        return $response->getContent();
    }

    private function doPutRequest(string $url, string $jsonBody)
    {
        $response = $this->client->request(
            'POST',
            self::BASE_URL . $url,
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->authKey,
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ],
                'body' => $jsonBody,
            ]
        );
        return $response->getContent();
    }

    private function doDeleteRequest(string $url, array $query = [])
    {
        $response = $this->client->request(
            'GET',
            self::BASE_URL . $url,
            [
                'query' => $query
            ]
        );

        return $response->getContent();
    }

    public function createOrder(CreateOrderRequest $body): InvoiceboxOrderData
    {
        $body->setMerchantId($this->merchantId);

        $body = $this->serializer->serialize($body);
        $response = $this->doPostRequest('/v3/billing/api/order/order', $body);

        $responseData = $this->serializer->deserialize($response, InvoiceboxOrderCreateResponse::class);

        if ($responseData->getData()) {
            return $responseData->getData();
        }

        throw new InvalidArgument($responseData->getResultMessage());
    }
}
