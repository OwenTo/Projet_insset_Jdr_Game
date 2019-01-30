<?php

namespace App\Repository;

use App\Entity\TypeRace;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TypeRace|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeRace|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeRace[]    findAll()
 * @method TypeRace[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeRaceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TypeRace::class);
    }

    // /**
    //  * @return TypeRace[] Returns an array of TypeRace objects
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
    public function findOneBySomeField($value): ?TypeRace
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
