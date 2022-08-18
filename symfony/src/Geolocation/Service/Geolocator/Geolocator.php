<?php

namespace App\Geolocation\Service\Geolocator;

use App\Geolocation\Api\IpifyApiClient;
use App\Geolocation\Exception\GetGeolocationException;
use App\Geolocation\Exception\Validation\IpValidationException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;

class Geolocator implements GeolocationInterface
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
     * @throws GetGeolocationException
     * @throws IpValidationException
     */
    public function getGeolocation(string $ip): array
    {
            $ipIsValid = $this->validateIp($ip);
            if(!$ipIsValid) {
                throw new IpValidationException($ip);
            }

            try {
               $geolocation_cache = $this->apiClient->request(Request::METHOD_GET, '/api/v2/country,city', ['query' => ['ipAddress' => $ip]]);

               return $geolocation_cache['location'];
            } catch (ExceptionInterface $e) {
                throw new GetGeolocationException($ip, $e);
        }
    }

    /**
     * @param string $ip
     * @return string
     */
    public function validateIp(string $ip): string
    {
        return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
    }
}
