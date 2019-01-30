<?php

namespace App\Repository;

use App\Entity\TypeTalent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TypeTalent|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeTalent|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeTalent[]    findAll()
 * @method TypeTalent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeTalentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TypeTalent::class);
    }

    // /**
    //  * @return TypeTalent[] Returns an array of TypeTalent objects
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
    public function findOneBySomeField($value): ?TypeTalent
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
