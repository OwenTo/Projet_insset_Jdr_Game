<?php

namespace App\Repository;

use App\Entity\InventaireItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method InventaireItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method InventaireItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method InventaireItem[]    findAll()
 * @method InventaireItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InventaireItemRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, InventaireItem::class);
    }

    // /**
    //  * @return InventaireItem[] Returns an array of InventaireItem objects
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
    public function findOneBySomeField($value): ?InventaireItem
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
