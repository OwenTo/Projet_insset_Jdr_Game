<?php

namespace App\Repository;

use App\Entity\CapaciteRacial;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CapaciteRacial|null find($id, $lockMode = null, $lockVersion = null)
 * @method CapaciteRacial|null findOneBy(array $criteria, array $orderBy = null)
 * @method CapaciteRacial[]    findAll()
 * @method CapaciteRacial[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CapaciteRacialRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CapaciteRacial::class);
    }

    // /**
    //  * @return CapaciteRacial[] Returns an array of CapaciteRacial objects
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
    public function findOneBySomeField($value): ?CapaciteRacial
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
