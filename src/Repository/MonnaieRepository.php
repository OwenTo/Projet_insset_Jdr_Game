<?php

namespace App\Repository;

use App\Entity\Monnaie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Monnaie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Monnaie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Monnaie[]    findAll()
 * @method Monnaie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MonnaieRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Monnaie::class);
    }

    // /**
    //  * @return Monnaie[] Returns an array of Monnaie objects
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
    public function findOneBySomeField($value): ?Monnaie
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
