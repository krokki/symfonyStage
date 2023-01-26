<?php

namespace App\Repository;

use App\Entity\GeolocationCache;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GeolocationCache>
 *
 * @method GeolocationCache|null find($id, $lockMode = null, $lockVersion = null)
 * @method GeolocationCache|null findOneBy(array $criteria, array $orderBy = null)
 * @method GeolocationCache[]    findAll()
 * @method GeolocationCache[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GeolocationCacheRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GeolocationCache::class);
    }
}
