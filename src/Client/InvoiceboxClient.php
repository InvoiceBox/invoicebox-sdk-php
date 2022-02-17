<?php

namespace Invoicebox\Sdk\Client;

use Invoicebox\Sdk\DTO\CreateOrderRequest\CreateOrderRequest;
use Invoicebox\Sdk\DTO\CreateOrderResponse\CreateOrderResponse;
use Invoicebox\Sdk\DTO\CreateOrderResponse\CreateOrderResponseData;
use Invoicebox\Sdk\Exception\InvalidArgument;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class InvoiceboxClient
{
    private const BASE_URL = 'https://api.stage.invbox.ru/';

    private HttpClientInterface $client;
    private string $authKey;
    private string $defaultMerchantId;

    public function __construct(
        HttpClientInterface $client,
        string $authKey,
        string $defaultMerchantId = ''
    ) {
        $this->client = $client;
        $this->authKey = $authKey;
        $this->defaultMerchantId = $defaultMerchantId;
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

        return $response->getContent(false);
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

        return $response->getContent(false);
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

        return $response->getContent(false);
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

        return $response->getContent(false);
    }

    public function createOrder(CreateOrderRequest $createOrderRequest, string $merchantId = null): CreateOrderResponseData
    {
        if ($merchantId) {
            $createOrderRequest->setMerchantId($merchantId);
        } elseif ($this->defaultMerchantId !== '') {
            $createOrderRequest->setMerchantId($this->defaultMerchantId);
        } else {
            throw new InvalidArgument('Empty merchant id');
        }

        $response = $this->doPostRequest('/v3/billing/api/order/order', json_encode($createOrderRequest->toArray()));

        $responseData = new CreateOrderResponse();
        $responseData->fromArray(json_decode($response,true));

        if ($responseData->getData() !== null) {
            return $responseData->getData();
        }

        throw new InvalidArgument($responseData['resultMessage']);
    }
}
