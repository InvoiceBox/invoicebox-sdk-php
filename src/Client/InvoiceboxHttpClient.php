<?php

namespace Invoicebox\Sdk\Client;

use Invoicebox\Sdk\Exception\InvalidArgument;
use Symfony\Component\HttpClient\Exception\JsonException;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class InvoiceboxHttpClient
{
    private HttpClientInterface $client;
    private string $authKey;
    private string $apiUrl;

    public function __construct(
        HttpClientInterface $client,
        string $apiUrl,
        string $authKey
    ) {
        $this->client = $client;
        $this->apiUrl = $apiUrl;
        $this->authKey = $authKey;
    }

    public function doPostRequest(string $url, array $body): array
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

        return $this->prepareResponse($response);
    }

    public function doGetRequest(string $url, array $query = []): array
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

        return $this->prepareResponse($response);
    }

    public function doPutRequest(string $url, array $body): array
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

        return $this->prepareResponse($response);
    }

    public function doDeleteRequest(string $url, array $query = []): array
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
            throw new InvalidArgument($responseData['error']['code']);
        }

        if (isset($responseData['data'])) {
            return $responseData['data'];
        }

        throw new InvalidArgument('wrong_response');
    }
}
