<?php

namespace App\Repository;

use App\Entity\Categorie;
use App\Entity\Peinture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Peinture>
 */
class PeintureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Peinture::class);
    }

        /**
         * @return Peinture[] Returns an array of Peinture objects
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

    public function findAllPortfolio(Categorie $categorie): array
    {
        return $this->createQueryBuilder('p')
            ->where(':categorie MEMBER OF p.categorie')
            ->andWhere('p.portfolio = TRUE')
            ->setParameter('categorie', $categorie) // Passez l'objet entier ici
            ->getQuery()
            ->getResult();
    }

}
