<?php

namespace App\Geolocation\Service\Geolocator;

use App\Geolocation\Exception\GetGeolocationException;
use App\Geolocation\Exception\Validation\IpValidationException;

/**
 * Предоставляет метод запроса геолокации по ip-адресу.
 */

interface GeolocationInterface
{
    /**
     * @param string $ip
     * @return array
     * @throws GetGeolocationException
     * @throws IpValidationException
     */
    public function getGeolocation(string $ip): array;
}
