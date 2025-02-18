<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AproposFunctionalTest extends WebTestCase
{
    public function testDisplayApropos(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/a-propos');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('p', 'Eum ab ipsam excepturi ex et ut magni adipisci. Repellendus enim aperiam cupiditate debitis. Voluptas incidunt delectus aperiam dolorum accusamus error tempore.');

    }
}
