<?php

namespace App\Repository;

use App\Entity\Magie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Magie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Magie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Magie[]    findAll()
 * @method Magie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MagieRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Magie::class);
    }

    // /**
    //  * @return Magie[] Returns an array of Magie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Magie
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
