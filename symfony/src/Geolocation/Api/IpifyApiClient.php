<?php

namespace App\Geolocation\Api;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class IpifyApiClient
{
    public string $apiKey;
    public HttpClientInterface $httpClient;

    /**
     * @param string $apiKey
     */
    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->httpClient = HttpClient::create(['base_uri' => 'https://geo.ipify.org']);
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return array
     * @throws ExceptionInterface
     */
    public function request(string $method, string $uri, array $options): array
    {
        $options['query']['apiKey'] = $this->apiKey;
        $response = $this->httpClient->request($method, $uri, $options);

        return $response->toArray();
    }
}
