<?php

namespace App\Repository;

use App\Entity\TypeMagie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TypeMagie|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeMagie|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeMagie[]    findAll()
 * @method TypeMagie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeMagieRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TypeMagie::class);
    }

    // /**
    //  * @return TypeMagie[] Returns an array of TypeMagie objects
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
    public function findOneBySomeField($value): ?TypeMagie
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
