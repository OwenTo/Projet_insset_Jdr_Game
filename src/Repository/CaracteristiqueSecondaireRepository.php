<?php

namespace App\Repository;

use App\Entity\CaracteristiqueSecondaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CaracteristiqueSecondaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method CaracteristiqueSecondaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method CaracteristiqueSecondaire[]    findAll()
 * @method CaracteristiqueSecondaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CaracteristiqueSecondaireRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CaracteristiqueSecondaire::class);
    }

    // /**
    //  * @return CaracteristiqueSecondaire[] Returns an array of CaracteristiqueSecondaire objects
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
    public function findOneBySomeField($value): ?CaracteristiqueSecondaire
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
