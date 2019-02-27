<?php

namespace App\Repository;

use App\Entity\InventaireMagie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method InventaireMagie|null find($id, $lockMode = null, $lockVersion = null)
 * @method InventaireMagie|null findOneBy(array $criteria, array $orderBy = null)
 * @method InventaireMagie[]    findAll()
 * @method InventaireMagie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InventaireMagieRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, InventaireMagie::class);
    }

    // /**
    //  * @return InventaireMagie[] Returns an array of InventaireMagie objects
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
    public function findOneBySomeField($value): ?InventaireMagie
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */



//SELECT* FROM inventaire_item
//JOIN personnage_inventaire_item on personnage_inventaire_item.inventaire_item_id=inventaire_item.id
//JOIN personnage on personnage_inventaire_item.personnage_id=personnage.id
//WHERE personnage.id=x
//AND inventaire_item.enfant LIKE "inventaireMagie"

    public function findInventaireMagie($value)
    {
//        return $this->createQueryBuilder('m')
//            ->select('m')
//            ->from('m.inventaire_arme')
//            ->innerJoin("personnage_inventaire_item.inventaire_item_id=inventaire_arme.id")
//            ->innerJoin("personnage on personnage_inventaire_item.personnage_id=personnage.id")
//            ->where("personnage.id".$value)
//            ->getQuery()
//            ->getResult()
//            ;
    }


}
