<?php

namespace App\Repository;

use App\Entity\ERRf;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ERRf|null find($id, $lockMode = null, $lockVersion = null)
 * @method ERRf|null findOneBy(array $criteria, array $orderBy = null)
 * @method ERRf[]    findAll()
 * @method ERRf[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ERRfRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ERRf::class);
    }

    // /**
    //  * @return ERRf[] Returns an array of ERRf objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ERRf
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
