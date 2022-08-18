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
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GeolocationCache::class);
    }

    public function add(GeolocationCache $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(GeolocationCache $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return GeolocationCache[] Returns an array of GeolocationCache objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?GeolocationCache
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
