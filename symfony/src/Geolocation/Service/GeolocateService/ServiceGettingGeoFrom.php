<?php

namespace App\Geolocation\Service\GeolocateService;

use App\Geolocation\Api\IpifyApiClientService;


class ServiceGettingGeoFrom implements GettingGeoFromIpInterface
{
    public Geolocator $geolocator;
    public Cacher $cacher;

    public IpifyApiClientService $apiClient;

    /**
     * @param Geolocator $geolocator
     * @param Cacher $cacher
 * @param IpifyApiClientService $apiClient
     */
    public function __construct(Geolocator $geolocator, Cacher $cacher, IpifyApiClientService $apiClient)
    {
        $this->geolocator = $geolocator;
        $this->cacher = $cacher;

        $this->apiClient = $apiClient;
    }

    public function getGeolocate(string $ip): array
    {
        //cache return cache
        $cache = $this->cacher->getFromCache("122.2.2.1");
        if(!$cache) {
            $geo = $this->geolocator->getGeo("122.2.2.1");
            $this->cacher->setToCache($geo);
            return $geo;
        }
        else {
            return $cache;
        }
    }
}
