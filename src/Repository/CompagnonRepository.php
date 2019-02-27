<?php

namespace App\Repository;

use App\Entity\Compagnon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Compagnon|null find($id, $lockMode = null, $lockVersion = null)
 * @method Compagnon|null findOneBy(array $criteria, array $orderBy = null)
 * @method Compagnon[]    findAll()
 * @method Compagnon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompagnonRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Compagnon::class);
    }

    // /**
    //  * @return Compagnon[] Returns an array of Compagnon objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Compagnon
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
