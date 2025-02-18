<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PortfolioFunctionalTest  extends WebTestCase
{
    public function testPortfolioPage(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/portfolio');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'réalisations');
    }

    public function testPortfolioCategorie(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/portfolio/categorie-test');

        $this->assertSelectorTextContains('h1', ' categorie test');
    }
}
