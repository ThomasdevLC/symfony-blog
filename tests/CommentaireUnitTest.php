<?php

namespace App\Tests;

use App\Entity\Commentaire;
use App\Entity\Peinture;
use App\Entity\Blogpost;
use PHPUnit\Framework\TestCase;

class CommentaireUnitTest extends TestCase
{
    public function testGettersAndSetters(): void
    {
        $commentaire = new Commentaire();

        $commentaire->setAuteur('Jean Dupont');
        $this->assertEquals('Jean Dupont', $commentaire->getAuteur());

        $commentaire->setEmail('jean.dupont@example.com');
        $this->assertEquals('jean.dupont@example.com', $commentaire->getEmail());

        $commentaire->setContenu('Très belle œuvre d’art, j’adore !');
        $this->assertEquals('Très belle œuvre d’art, j’adore !', $commentaire->getContenu());

        $createdAt = new \DateTime();
        $commentaire->setCreatedAt($createdAt);
        $this->assertEquals($createdAt, $commentaire->getCreatedAt());
    }

    public function testPeintureAssociation(): void
    {
        $commentaire = new Commentaire();
        $peinture = new Peinture();

        $commentaire->setPeinture($peinture);
        $this->assertEquals($peinture, $commentaire->getPeinture());
    }

    public function testBlogpostAssociation(): void
    {
        $commentaire = new Commentaire();
        $blogpost = new Blogpost();

        $commentaire->setBlogpost($blogpost);
        $this->assertEquals($blogpost, $commentaire->getBlogpost());
    }
}
