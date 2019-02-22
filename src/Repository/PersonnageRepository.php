<?php

namespace App\Repository;

use App\Entity\Personnage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Personnage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Personnage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Personnage[]    findAll()
 * @method Personnage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonnageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Personnage::class);
    }

    // /**
    //  * @return Personnage[] Returns an array of Personnage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Personnage
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


    //SELECT* FROM inventaire_arme
//JOIN personnage_inventaire_item on personnage_inventaire_item.inventaire_item_id=inventaire_arme.id
//JOIN personnage on personnage_inventaire_item.personnage_id=personnage.id
//WHERE personnage.id=X

    public function findInventaireArme($value): ArrayCollection
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            ' SELECT  
            FROM App\Entity\InventaireArme
            WHERE App\Entity\Personnage= :personnage')
        ->setParameter('personnage',$value);

        return $query->execute();


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




//SELECT* FROM inventaire_armure
//JOIN personnage_inventaire_item on personnage_inventaire_item.inventaire_item_id=inventaire_armure.id
//JOIN personnage on personnage_inventaire_item.personnage_id=personnage.id
//WHERE personnage.id=X


    public function findInventaireArmure($value){
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


//SELECT* FROM inventaire_magie
//JOIN personnage_inventaire_item on personnage_inventaire_item.inventaire_item_id=inventaire_arme.id
//JOIN personnage on personnage_inventaire_item.personnage_id=personnage.id
//WHERE personnage.id=X

    public function findInventaireMagie($value){
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




