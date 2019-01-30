<?php

namespace App\Repository;

use App\Entity\CaracteristiquePrincipal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CaracteristiquePrincipal|null find($id, $lockMode = null, $lockVersion = null)
 * @method CaracteristiquePrincipal|null findOneBy(array $criteria, array $orderBy = null)
 * @method CaracteristiquePrincipal[]    findAll()
 * @method CaracteristiquePrincipal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CaracteristiquePrincipalRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CaracteristiquePrincipal::class);
    }

    // /**
    //  * @return CaracteristiquePrincipal[] Returns an array of CaracteristiquePrincipal objects
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
    public function findOneBySomeField($value): ?CaracteristiquePrincipal
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
