<?php

namespace App\Repository;

use App\Entity\SujetMail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SujetMail|null find($id, $lockMode = null, $lockVersion = null)
 * @method SujetMail|null findOneBy(array $criteria, array $orderBy = null)
 * @method SujetMail[]    findAll()
 * @method SujetMail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SujetMailRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SujetMail::class);
    }

    // /**
    //  * @return SujetMail[] Returns an array of SujetMail objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SujetMail
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
