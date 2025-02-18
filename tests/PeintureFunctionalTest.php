<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PeintureFunctionalTest  extends WebTestCase
{
    public function testPeinturePage(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/realisations');

        $this->assertSelectorTextContains('h1', 'Réalisations');
    }

    public function testSinglePeinturePage(): void

    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/realisations/peinture-test');

        $this->assertSelectorTextContains('h1', 'peinture test');
    }
}
