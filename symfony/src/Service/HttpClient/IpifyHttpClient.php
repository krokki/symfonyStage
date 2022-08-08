<?php

namespace App\Service\HttpClient;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\ResponseInterface;

class IpifyHttpClient
{
    private const IPIFY_URL = 'https://api.ipify.org';
    private HttpClientInterface $httpClient;

    public function __construct()
    {
        $this->httpClient = HttpClient::create(['base_uri' => self::IPIFY_URL]);
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function request(string $method, string $url, array $options): ResponseInterface
    {
        $response = $this->httpClient->request($method, $url, $options);
        return $response;
    }
}
