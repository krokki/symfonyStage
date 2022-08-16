<?php

namespace App\Geolocation\Service\GeolocateService;

use App\Geolocation\Api\IpifyApiClient;
use App\Geolocation\Exception\GettingGeoException;
use App\Geolocation\Exception\Validation\IpValidationException;
use ProxyManager\Exception\ExceptionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use App\Geolocation\Exception;
use Throwable;

class Geolocator implements GettingGeoFromIpInterface
{
    public IpifyApiClient $apiClient;

    /**
     * @param IpifyApiClient $apiClient
     */
    public function __construct(IpifyApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * @param string $ip
     * @return array
     * @throws GettingGeoException
     * @throws IpValidationException
     */
    public function getGeolocate(string $ip): array
    {
            $ip = filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
            if(!$ip) {
                throw new IpValidationException('Ошибка распознавания ip адреса!');
            }

            try {
                return $this->apiClient->request(Request::METHOD_GET, '/api/v2/country,city', ['query' => ['ipAddress' => $ip]]);
            }
            catch (Throwable $e) {
                throw new GettingGeoException('Не удалось получить данные геолокации с текущего ip адреса: '.$ip, 0, $e);

        }
    }
}