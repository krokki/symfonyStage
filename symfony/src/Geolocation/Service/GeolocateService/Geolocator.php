<?php

namespace App\Geolocation\Service\GeolocateService;

use App\Geolocation\Api\IpifyApiClientService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class Geolocator implements GettingGeoFromIpInterface
{
    public IpifyApiClientService $apiClient;

    /**
     * @param IpifyApiClientService $apiClient
     */
    public function __construct(IpifyApiClientService $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function getGeolocate(string $ip): array
    {
        //1) php filter_var валидация ip и соответсвующее исключение

        try {
            try {
                $geo = $this->apiClient->request(Request::METHOD_GET, '/api/v2/country,city', ['query' => ['ipAddress' => $ip]]);
                return $geo;
            } catch (ClientExceptionInterface $e) {
            } catch (DecodingExceptionInterface $e) {
            } catch (RedirectionExceptionInterface $e) {
            } catch (ServerExceptionInterface $e) {
            } catch (TransportExceptionInterface $e) {
            }
        } catch (TransportExceptionInterface $e) {
        }
    }
}