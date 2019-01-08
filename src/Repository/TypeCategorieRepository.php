<?php

namespace App\Repository;

use App\Entity\TypeCategorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TypeCategorie|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeCategorie|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeCategorie[]    findAll()
 * @method TypeCategorie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeCategorieRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TypeCategorie::class);
    }

    // /**
    //  * @return TypeCategorie[] Returns an array of TypeCategorie objects
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
    public function findOneBySomeField($value): ?TypeCategorie
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
