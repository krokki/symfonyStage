<?php

namespace App\Geolocation\Service\Cache;

/**
 * Предоставляет методы для кеширования геолокации.
 */
interface CacheGeoInterface
{
    /**
     * @param string $ip
     * @return array|null
     */
    public function getFromCache(string $ip): ?array;

    /**
     * @param string $ip
     * @param array $geolocation
     * @return void
     */
    public function setToCache(string $ip, array $geolocation): void;
}