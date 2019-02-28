<?php

namespace App\Repository;

use App\Entity\ChoixPersonnage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ChoixPersonnage|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChoixPersonnage|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChoixPersonnage[]    findAll()
 * @method ChoixPersonnage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChoixPersonnageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ChoixPersonnage::class);
    }

    // /**
    //  * @return ChoixPersonnage[] Returns an array of ChoixPersonnage objects
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
    public function findOneBySomeField($value): ?ChoixPersonnage
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
