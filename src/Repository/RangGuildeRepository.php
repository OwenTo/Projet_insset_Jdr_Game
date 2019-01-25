<?php

namespace App\Repository;

use App\Entity\RangGuilde;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RangGuilde|null find($id, $lockMode = null, $lockVersion = null)
 * @method RangGuilde|null findOneBy(array $criteria, array $orderBy = null)
 * @method RangGuilde[]    findAll()
 * @method RangGuilde[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RangGuildeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RangGuilde::class);
    }

    // /**
    //  * @return RangGuilde[] Returns an array of RangGuilde objects
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
    public function findOneBySomeField($value): ?RangGuilde
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
