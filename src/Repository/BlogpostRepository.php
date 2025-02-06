<?php

namespace App\Repository;

use App\Entity\Blogpost;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Blogpost>
 */
class BlogpostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Blogpost::class);
    }

        /**
         * @return Blogpost[] Returns an array of Blogpost objects
         */
    public function lastTree(): array
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
            ;
    }

    //    public function findOneBySomeField($value): ?Blogpost
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
