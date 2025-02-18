<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeFunctionalTest extends WebTestCase
{
    public function testDisplayHomepage(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertSelectorTextContains('p', 'Jacqueline');
        $this->assertSelectorTextContains('p', 'Boyer');
        $this->assertSelectorTextContains('p', 'Eum ab ipsam excepturi ex et ut magni adipisci. Repellendus enim aperiam cupiditate debitis. Voluptas incidunt delectus aperiam dolorum accusamus error tempore.');
    }
}
