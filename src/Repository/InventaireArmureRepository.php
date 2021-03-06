<?php

namespace App\Repository;

use App\Entity\InventaireArmure;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method InventaireArmure|null find($id, $lockMode = null, $lockVersion = null)
 * @method InventaireArmure|null findOneBy(array $criteria, array $orderBy = null)
 * @method InventaireArmure[]    findAll()
 * @method InventaireArmure[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InventaireArmureRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, InventaireArmure::class);
    }

    // /**
    //  * @return InventaireArmure[] Returns an array of InventaireArmure objects
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
    public function findOneBySomeField($value): ?InventaireArmure
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
//AND inventaire_item.enfant LIKE "inventaireArmure"

    public function findInventaireArmure($value)
    {
//        return $this->createQueryBuilder('ar')
//            ->select('ar')
//            ->from('p.inventaire_arme')
//            ->innerJoin("personnage_inventaire_item.inventaire_item_id=inventaire_arme.id")
//            ->innerJoin("personnage on personnage_inventaire_item.personnage_id=personnage.id")
//            ->where("personnage.id".$value)
//            ->getQuery()
//            ->getResult()
//            ;
    }


}
