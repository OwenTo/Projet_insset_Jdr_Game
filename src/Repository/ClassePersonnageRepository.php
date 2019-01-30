<?php

namespace App\Repository;

use App\Entity\ClassePersonnage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ClassePersonnage|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClassePersonnage|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClassePersonnage[]    findAll()
 * @method ClassePersonnage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClassePersonnageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ClassePersonnage::class);
    }

    // /**
    //  * @return ClassePersonnage[] Returns an array of ClassePersonnage objects
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
    public function findOneBySomeField($value): ?ClassePersonnage
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
