<?php

namespace App\Repository;

use App\Entity\RegionLangue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RegionLangue|null find($id, $lockMode = null, $lockVersion = null)
 * @method RegionLangue|null findOneBy(array $criteria, array $orderBy = null)
 * @method RegionLangue[]    findAll()
 * @method RegionLangue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RegionLangueRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RegionLangue::class);
    }

    // /**
    //  * @return RegionLangue[] Returns an array of RegionLangue objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RegionLangue
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
