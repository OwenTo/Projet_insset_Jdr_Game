<?php

namespace App\Repository;

use App\Entity\ValeurCaract;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ValeurCaract|null find($id, $lockMode = null, $lockVersion = null)
 * @method ValeurCaract|null findOneBy(array $criteria, array $orderBy = null)
 * @method ValeurCaract[]    findAll()
 * @method ValeurCaract[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ValeurCaractRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ValeurCaract::class);
    }

    // /**
    //  * @return ValeurCaract[] Returns an array of ValeurCaract objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ValeurCaract
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
