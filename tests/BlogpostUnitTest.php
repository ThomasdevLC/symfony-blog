<?php

namespace App\Tests;

use App\Entity\Blogpost;
use App\Entity\Commentaire;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class BlogpostUnitTest extends TestCase
{
    public function testGettersAndSetters(): void
    {
        $blogpost = new Blogpost();

        $blogpost->setTitre('Symfony et PHPUnit');
        $this->assertEquals('Symfony et PHPUnit', $blogpost->getTitre());

        $blogpost->setContenu('Un tutoriel sur comment tester les entités Symfony avec PHPUnit.');
        $this->assertEquals('Un tutoriel sur comment tester les entités Symfony avec PHPUnit.', $blogpost->getContenu());

        $blogpost->setSlug('symfony-et-phpunit');
        $this->assertEquals('symfony-et-phpunit', $blogpost->getSlug());

        $createdAt = new \DateTime();
        $blogpost->setCreatedAt($createdAt);
        $this->assertEquals($createdAt, $blogpost->getCreatedAt());
    }

    public function testUserAssociation(): void
    {
        $blogpost = new Blogpost();
        $user = new User();

        $blogpost->setUser($user);
        $this->assertEquals($user, $blogpost->getUser());
        $this->assertNull($blogpost->getId());
    }

    public function testAddGetRemoveComment(): void
    {
        $blogpost = new Blogpost();
        $commentaire = new Commentaire();

        $this->assertEmpty($blogpost->getCommentaires());

        $blogpost->addCommentaire($commentaire);
        $this->assertContains($commentaire, $blogpost->getCommentaires());

        $blogpost->removeCommentaire($commentaire);
        $this->assertEmpty($blogpost->getCommentaires());
    }

}
