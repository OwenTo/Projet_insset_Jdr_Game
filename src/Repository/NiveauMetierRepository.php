<?php

namespace App\Repository;

use App\Entity\NiveauMetier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method NiveauMetier|null find($id, $lockMode = null, $lockVersion = null)
 * @method NiveauMetier|null findOneBy(array $criteria, array $orderBy = null)
 * @method NiveauMetier[]    findAll()
 * @method NiveauMetier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NiveauMetierRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, NiveauMetier::class);
    }

    // /**
    //  * @return NiveauMetier[] Returns an array of NiveauMetier objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NiveauMetier
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
