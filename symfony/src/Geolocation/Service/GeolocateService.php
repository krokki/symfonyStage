<?php

namespace App\Geolocation\Service;

use App\Geolocation\Exception\GetGeolocationException;
use App\Geolocation\Exception\Validation\IpValidationException;
use App\Geolocation\Service\Cache\CacheGeoInterface;
use App\Geolocation\Service\Geolocator\Geolocator;
use App\Geolocation\Service\Geolocator\GeolocationInterface;

class GeolocateService implements GeolocationInterface
{
    public Geolocator $geolocator;
    public CacheGeoInterface $cacher;

    /**
     * @param Geolocator $geolocator
     * @param CacheGeoInterface $cacher
     */
    public function __construct(GeolocationInterface $geolocator, CacheGeoInterface $cacher)
    {
        $this->geolocator = $geolocator;
        $this->cacher = $cacher;
    }

    /**
     * @param string $ip
     * @return array
     * @throws GetGeolocationException
     * @throws IpValidationException
     */
    public function getNewGeolocate(string $ip): array
    {
        $geolocation = $this->geolocator->getGeolocation($ip);
        $this->cacher->setToCache($ip, $geolocation);

        return $geolocation;
    }

    /**
     * @throws IpValidationException
     * @throws GetGeolocationException
     */
    public function getGeolocation(string $ip): array
    {
        $geoData = $this->cacher->getFromCache($ip);
        if(!$geoData) {
            $geoData = $this->getNewGeolocate($ip);
        }
       return $geoData;
    }
}

