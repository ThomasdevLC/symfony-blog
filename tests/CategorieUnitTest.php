<?php

namespace App\Tests;

use App\Entity\Categorie;
use App\Entity\Peinture;
use PHPUnit\Framework\TestCase;

class CategorieUnitTest extends TestCase
{
    public function testGettersAndSetters(): void
    {
        $categorie = new Categorie();

        $categorie->setNom('Technologie');
        $this->assertEquals('Technologie', $categorie->getNom());

        $categorie->setDescription('Catégorie dédiée aux nouvelles technologies et innovations.');
        $this->assertEquals('Catégorie dédiée aux nouvelles technologies et innovations.', $categorie->getDescription());

        $categorie->setSlug('technologie');
        $this->assertEquals('technologie', $categorie->getSlug());
        $this->assertNull($categorie->getId());

    }

    public function testAddGetRemovePeinture(): void
    {
        $categorie = new Categorie();
        $peinture = new Peinture();

        $this->assertEmpty($categorie->getPeintures());

        $categorie->addPeinture($peinture);
        $this->assertContains($peinture, $categorie->getPeintures());

        $categorie->removePeinture($peinture);
        $this->assertEmpty($categorie->getPeintures());
    }


}
