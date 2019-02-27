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



//SELECT* FROM inventaire_item
//JOIN personnage_inventaire_item on personnage_inventaire_item.inventaire_item_id=inventaire_item.id
//JOIN personnage on personnage_inventaire_item.personnage_id=personnage.id
//WHERE personnage.id=x
//AND inventaire_item.enfant LIKE "inventaireArme"


    public function findInventaireArme($value)
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'Select arme 
            FROM App\Entity\InventaireItem arme
            JOIN  App\Entity\Personnage personnage WITH
            
 '
        )->setParameter('idPersonnage',$value);

//      $sql ="SELECT arme
//      FROM App\Entity\InventaireItem arme
//JOIN personnage_inventaire_item item on item.inventaire_item_id=arme.id
//JOIN App:Personnage personnage on item.personnage_id=personnage.id
//WHERE personnage.id=".$value." AND  item.enfant like 'inventaireArme'";
//
//
//
//$qb=$this->createQueryBuilder($sql)->getQuery()->getResult();
//
//return $qb;



//       return $qb->execute();
//        $sql = "SELECT
//                a.id,
//                a.nomItemInventaire,
//                a.descriptionItemInventaire,
//                a.descriptionItemInventaire
//         FROM App:InventaireArme
//         INNER JOIN App:Personnage p WITH p.idPersonnage=a.idPersonnage
//         WHERE p.personnage=:idPersonnage ";
//
//
//        $resultat = $entityManager->createQuery('a',$sql)->setParameter('idPersonnage', $value)->getResult();
//        return $resultat;

//        $resultat = $entityManager->createQuery("
//        SELECT a
//        FROM App:InventaireArme a
//         INNER JOIN App:Personnage p WITH p.idPersonnage=a.idPersonnage
//        WHERE p.idPersonnage=:id ")
//        ->setParameter('id',$value);
//        return $resultat->execute();

//        $query = $entityManager->createQuery(
//            " SELECT
//            FROM App\Entity\InventaireArme
//            WHERE App\Entity\Personnage= :personnage")
//        ->setParameter('personnage',$value);
//
//        return $query->execute();


//        return $this->createQueryBuilder('a')
//            ->select('a')
//            ->where('a.personnage = (:personnages) ')
//            ->getQuery()
//            ->setParameter('personnages' , $value)
//            ->getResult();

//        ->select('a')
//            ->from('p.inventaire_arme')
//            ->innerJoin("personnage_inventaire_item.inventaire_item_id=inventaire_arme.id")
//            ->innerJoin("personnage on personnage_inventaire_item.personnage_id=personnage.id")
//            ->where("personnage.id".$value)
//            ->getQuery()
//            ->getResult()

    }

}






