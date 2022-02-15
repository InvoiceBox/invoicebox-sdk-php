<?php

namespace Invoicebox\Sdk\Client;

use Invoicebox\Sdk\DTO\CreateOrderRequest\CreateOrderRequest;
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

        if (!$response->getStatusCode() >= 300) {
            return $response->getContent();
        }
        //какое сообщение сюда передать?
        throw new InvalidArgument();
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

        if (!$response->getStatusCode() >= 300) {
            return $response->getContent();
        }
        //какое сообщение сюда передать?
        throw new InvalidArgument();

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

        if (!$response->getStatusCode() >= 300) {
            return $response->getContent();
        }
        //какое сообщение сюда передать?
        throw new InvalidArgument();
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

        if (!$response->getStatusCode() >= 300) {
            return $response->getContent();
        }
        //какое сообщение сюда передать?
        throw new InvalidArgument();
    }

    public function createOrder(CreateOrderRequest $body, string $merchantId = ''): array
    {
        if ($merchantId !== '') {
            $body->setMerchantId($merchantId);
        } elseif ($this->defaultMerchantId !== '') {
            $body->setMerchantId($this->defaultMerchantId);
        } else {
            throw new InvalidArgument('Empty merchant id');
        }

        $response = $this->doPostRequest('/v3/billing/api/order/order', json_encode($body->toArray()));

        $responseData = json_decode($response);

        if (isset($responseData['data'])) {
            return $responseData['data'];
        }

        throw new InvalidArgument($responseData['resultMessage']);
    }
}
