<?php

namespace App\Geolocation\Service\GeolocateService;

use App\Geolocation\Exception\GettingGeoException;
use App\Geolocation\Exception\Validation\IpValidationException;

interface GettingGeoFromIpInterface
{
    /**
     * Определяет геолокацию по ip адресу
     * @param string $ip
     * @return array
     * @throws GettingGeoException
     * @throws IpValidationException
     */
    public function getGeolocate(string $ip): array;
}
