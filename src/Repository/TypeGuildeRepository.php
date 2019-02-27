<?php

namespace App\Repository;

use App\Entity\TypeGuilde;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TypeGuilde|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeGuilde|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeGuilde[]    findAll()
 * @method TypeGuilde[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeGuildeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TypeGuilde::class);
    }

    // /**
    //  * @return TypeGuilde[] Returns an array of TypeGuilde objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeGuilde
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
