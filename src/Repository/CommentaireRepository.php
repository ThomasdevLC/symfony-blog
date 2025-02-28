<?php

namespace App\Repository;

use App\Entity\Blogpost;
use App\Entity\Commentaire;
use App\Entity\Peinture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Commentaire>
 */
class CommentaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commentaire::class);
    }

    /**
     * Récupère les commentaires publiés pour un blogpost ou une peinture
     *
     * @param Blogpost|Peinture $value
     * @return Commentaire[] Returns an array of Commentaire objects
     */
    public function findCommentaires($value): array
    {
        if ($value instanceof Blogpost) {
            $object = 'blogpost';
        } elseif ($value instanceof Peinture) {
            $object = 'peinture';
        } else {
            throw new \InvalidArgumentException('L\'objet doit être une instance de Blogpost ou Peinture.');
        }

        return $this->createQueryBuilder('c')
            ->andWhere("c.$object = :val")
            ->andWhere('c.isPublished = true')
            ->setParameter('val', $value->getId())
            ->orderBy('c.id', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
