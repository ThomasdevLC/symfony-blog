<?php

namespace App\Tests;

use App\Entity\Categorie;
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
    }
}
