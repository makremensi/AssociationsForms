<?php

namespace App\Repository;

use App\Entity\Arbitres;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Arbitres|null find($id, $lockMode = null, $lockVersion = null)
 * @method Arbitres|null findOneBy(array $criteria, array $orderBy = null)
 * @method Arbitres[]    findAll()
 * @method Arbitres[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArbitresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Arbitres::class);
    }

    // /**
    //  * @return Arbitres[] Returns an array of Arbitres objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Arbitres
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
