<?php

namespace App\Repository;

use App\Entity\LangueType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method LangueType|null find($id, $lockMode = null, $lockVersion = null)
 * @method LangueType|null findOneBy(array $criteria, array $orderBy = null)
 * @method LangueType[]    findAll()
 * @method LangueType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LangueTypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LangueType::class);
    }

    // /**
    //  * @return LangueType[] Returns an array of LangueType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LangueType
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
