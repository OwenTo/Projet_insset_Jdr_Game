<?php

namespace App\Repository;

use App\Entity\InventaireMagie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method InventaireMagie|null find($id, $lockMode = null, $lockVersion = null)
 * @method InventaireMagie|null findOneBy(array $criteria, array $orderBy = null)
 * @method InventaireMagie[]    findAll()
 * @method InventaireMagie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InventaireMagieRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, InventaireMagie::class);
    }

    // /**
    //  * @return InventaireMagie[] Returns an array of InventaireMagie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InventaireMagie
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
