<?php

namespace App\Tests;

use App\Entity\Peinture;
use App\Entity\User;
use App\Entity\Categorie;
use PHPUnit\Framework\TestCase;

class PeintureUnitTest extends TestCase
{
    public function testGettersAndSetters(): void
    {
        $peinture = new Peinture();

        $peinture->setNom('Paysage de Montagne');
        $this->assertEquals('Paysage de Montagne', $peinture->getNom());

        $peinture->setLargeur('100.50');
        $this->assertEquals('100.50', $peinture->getLargeur());

        $peinture->setHauteur('200.75');
        $this->assertEquals('200.75', $peinture->getHauteur());

        $peinture->setEnVente(true);
        $this->assertTrue($peinture->isEnVente());

        $peinture->setPrix('1500.00');
        $this->assertEquals('1500.00', $peinture->getPrix());

        $dateRealisation = new \DateTime();
        $peinture->setDateRealisation($dateRealisation);
        $this->assertEquals($dateRealisation, $peinture->getDateRealisation());

        $createdAt = new \DateTime();
        $peinture->setCreatedAt($createdAt);
        $this->assertEquals($createdAt, $peinture->getCreatedAt());

        $peinture->setDescription('Une belle peinture de montagne avec des couleurs vibrantes.');
        $this->assertEquals('Une belle peinture de montagne avec des couleurs vibrantes.', $peinture->getDescription());

        $peinture->setPortfolio(true);
        $this->assertTrue($peinture->isPortfolio());

        $peinture->setSlug('paysage-de-montagne');
        $this->assertEquals('paysage-de-montagne', $peinture->getSlug());

        $peinture->setFile('peinture.jpg');
        $this->assertEquals('peinture.jpg', $peinture->getFile());
    }

    public function testUserAssociation(): void
    {
        $peinture = new Peinture();
        $user = new User();

        $peinture->setUser($user);
        $this->assertEquals($user, $peinture->getUser());
    }

    public function testCategorieAssociation(): void
    {
        $peinture = new Peinture();
        $categorie1 = new Categorie();
        $categorie2 = new Categorie();

        $peinture->addCategorie($categorie1);
        $peinture->addCategorie($categorie2);

        $this->assertCount(2, $peinture->getCategorie());
        $this->assertTrue($peinture->getCategorie()->contains($categorie1));
        $this->assertTrue($peinture->getCategorie()->contains($categorie2));

        $peinture->removeCategorie($categorie1);
        $this->assertCount(1, $peinture->getCategorie());
        $this->assertFalse($peinture->getCategorie()->contains($categorie1));
    }
}
