<?php

namespace App\Service;

use App\Entity\Blogpost;
use App\Entity\Commentaire;
use App\Entity\Peinture;
use Doctrine\ORM\EntityManagerInterface;

class CommentaireService
{
    private $manager;

    public function __construct(EntityManagerInterface $manager,)
    {
        $this->manager = $manager;
    }

    public function persistCommentaire(

        Commentaire $commentaire,
        Blogpost    $blogpost = null,
        Peinture    $peinture = null
    ): void

    {
        $commentaire->setIsPublished(false);
        $commentaire->setBlogpost($blogpost);
        $commentaire->setPeinture($peinture);
        $commentaire->setCreatedAt(new \DateTime('now'));

        $this->manager->persist($commentaire);
        $this->manager->flush();


    }


}