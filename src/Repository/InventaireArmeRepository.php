<?php

namespace App\Repository;

use App\Entity\InventaireArme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method InventaireArme|null find($id, $lockMode = null, $lockVersion = null)
 * @method InventaireArme|null findOneBy(array $criteria, array $orderBy = null)
 * @method InventaireArme[]    findAll()
 * @method InventaireArme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InventaireArmeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, InventaireArme::class);
    }

    // /**
    //  * @return InventaireArme[] Returns an array of InventaireArme objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InventaireArme
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
