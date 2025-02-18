<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BlogpostFunctionalTest  extends WebTestCase
{
    public function testDisplayBlogpostPage(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/actualites');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Actualités');

    }

    public function testDisplayBlogpost(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/actualites/blogpost-test');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'blogpost test');

    }
}


