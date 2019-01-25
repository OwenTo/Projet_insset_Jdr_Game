<?php

namespace App\Repository;

use App\Entity\CompagnonType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CompagnonType|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompagnonType|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompagnonType[]    findAll()
 * @method CompagnonType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompagnonTypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CompagnonType::class);
    }

    // /**
    //  * @return CompagnonType[] Returns an array of CompagnonType objects
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
    public function findOneBySomeField($value): ?CompagnonType
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
