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
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if (isset($options['headers'])) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, self::returnHeaders($options['headers']));
        }
        if (isset($options['query'])) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($options['query']));
        }
        if (isset($options['json'])) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($options['json']));
        }

        $response = curl_exec($ch);
        curl_close($ch);

        if ($response === false) {
            $curl_code = curl_errno($ch);
            $curl_message = curl_error($ch);
            echo "Произошла ошибка. Код ошибки " . $curl_code . ", текст ошибки: " . $curl_message;
        }

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
