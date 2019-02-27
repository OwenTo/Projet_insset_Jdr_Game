<?php

namespace App\Repository;

use App\Entity\TypeDes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TypeDes|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeDes|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeDes[]    findAll()
 * @method TypeDes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeDesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TypeDes::class);
    }

    // /**
    //  * @return TypeDes[] Returns an array of TypeDes objects
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
    public function findOneBySomeField($value): ?TypeDes
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
