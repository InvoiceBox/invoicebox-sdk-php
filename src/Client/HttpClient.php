<?php

namespace Invoicebox\Sdk\Client;

class HttpClient
{
    public array $options;

    public const DEFAULT_OPTIONS = [
        'query' => [],          // string[] - associative array of query string values to merge with the request's URL
        'headers' => [],        // iterable|string[]|string[][] - headers names provided as keys or as part of values
        'body' => '',           // array|string|resource|\Traversable|\Closure - the callback SHOULD yield a string
        //   smaller than the amount requested as argument; the empty string signals EOF; if
        //   an array is passed, it is meant as a form payload of field names and values
        'json' => null,
    ];

    public function __construct($options = self::DEFAULT_OPTIONS)
    {
        $this->options = $options;
    }

    public function request(string $method, string $url, array $options = []): HttpResponse
    {
        $ch = curl_init();

        if ($method === 'GET' && !empty($options['query'])) {
            $queryString = http_build_query($options['query']);
            $url .= (strpos($url, '?') === false) ? '?' . $queryString : '&' . $queryString;
        }

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if (isset($options['headers'])) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, self::returnHeaders($options['headers']));
        }

        if ($method !== 'GET' && isset($options['json'])) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($options['json']));
        }

        $response = curl_exec($ch);

        if ($response === false) {
            $errorCode = curl_errno($ch);
            $errorMessage = curl_error($ch);
            curl_close($ch);
            throw new \RuntimeException("CURL error $errorCode: $errorMessage");
        }

        curl_close($ch);
        return new HttpResponse($response);
    }

    private function returnHeaders($headers): array
    {
        $correctHeaders = [];
        foreach ($headers as $key => $value) {
            $correctHeaders[] = $key . ":" . $value;
        }
        return $correctHeaders;
    }
}
