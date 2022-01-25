<?php

namespace App\Repository;

use App\Entity\VariationMasse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VariationMasse|null find($id, $lockMode = null, $lockVersion = null)
 * @method VariationMasse|null findOneBy(array $criteria, array $orderBy = null)
 * @method VariationMasse[]    findAll()
 * @method VariationMasse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VariationMasseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VariationMasse::class);
    }

    // /**
    //  * @return VariationMasse[] Returns an array of VariationMasse objects
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
    public function findOneBySomeField($value): ?VariationMasse
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