<?php

namespace App\Geolocation\Service\Cache;

use App\Entity\GeolocationCache;
use Doctrine\ORM\EntityManagerInterface;

class GeolocationDbCacher implements CacheGeoInterface
{
    public EntityManagerInterface $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @inheritDoc
     */
    public function setToCache(string $ip, array $geolocation): void
    {
        $cache = new GeolocationCache();
        $cache->setIp($ip);
        $cache->setGeolocation($geolocation);

        $this->entityManager->persist($cache);
        $this->entityManager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getFromCache(string $ip): ?array
    {
        $cache = $this->entityManager->getRepository(GeolocationCache::class)->findOneBy(['ip' => $ip]);
        if(!$cache) {
            return null;
        }
        return $cache->getGeolocation();
    }
}
