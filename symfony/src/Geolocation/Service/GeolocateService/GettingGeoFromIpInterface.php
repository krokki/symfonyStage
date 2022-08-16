<?php

namespace App\Geolocation\Service\GeolocateService;

interface GettingGeoFromIpInterface
{
    /**
     * Определяет геолокацию по ip адресу
     * @param string $ip
     * @return array
     */
    public function getGeolocate(string $ip): array;
}
