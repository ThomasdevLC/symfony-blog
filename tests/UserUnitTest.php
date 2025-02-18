<?php

namespace App\Tests;

use App\Entity\Blogpost;
use App\Entity\Peinture;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserUnitTest extends TestCase
{
    public function testGettersAndSetters(): void
    {
        $user = new User();

        $user->setEmail('test@example.com');
        $this->assertEquals('test@example.com', $user->getEmail());

        $user->setPrenom('John');
        $this->assertEquals('John', $user->getPrenom());

        $user->setNom('Doe');
        $this->assertEquals('Doe', $user->getNom());

        $user->setTelephone('0123456789');
        $this->assertEquals('0123456789', $user->getTelephone());

        $user->setAPropos('Développeur Symfony');
        $this->assertEquals('Développeur Symfony', $user->getAPropos());

        $user->setInstagram('@john_doe');
        $this->assertEquals('@john_doe', $user->getInstagram());
    }

    public function testRoles(): void
    {
        $user = new User();

        // Par défaut, l'utilisateur doit avoir ROLE_USER
        $this->assertContains('ROLE_USER', $user->getRoles());

        // Ajout d'un rôle personnalisé
        $user->setRoles(['ROLE_ADMIN']);
        $this->assertContains('ROLE_ADMIN', $user->getRoles());
        $this->assertContains('ROLE_USER', $user->getRoles()); // ROLE_USER doit toujours être là
    }

    public function testUserIdentifier(): void
    {
        $user = new User();
        $user->setEmail('identifier@example.com');

        $this->assertEquals('identifier@example.com', $user->getUserIdentifier());
        $this->assertNull($user->getId());

    }

    public function testPassword(): void
    {
        $user = new User();
        $user->setPassword('hashedpassword');

        $this->assertEquals('hashedpassword', $user->getPassword());
    }

    public function testEraseCredentials(): void
    {
        $user = new User();
        $user->eraseCredentials(); // Doit exécuter la méthode sans erreur

        $this->assertTrue(true); // Juste pour s'assurer qu'il n'y a pas d'erreur
    }

    public function testAddGetRemovePeinture(): void
    {
        $user = new User();
        $peinture = new Peinture();

        $this->assertEmpty($user->getPeintures());

        $user->addPeinture($peinture);
        $this->assertContains($peinture, $user->getPeintures());

        $user->removePeinture($peinture);
        $this->assertEmpty($user->getPeintures());
    }

    public function testAddGetRemoveBlogpost(): void
    {
        $user = new User();
        $blogpost = new Blogpost();

        $this->assertEmpty($user->getBlogposts());

        $user->addBlogpost($blogpost);
        $this->assertContains($blogpost, $user->getBlogposts());

        $user->removeBlogpost($blogpost);
        $this->assertEmpty($user->getBlogposts());
    }
}
