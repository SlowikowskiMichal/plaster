<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AptekarzControllerTest extends WebTestCase
{
    public function testHomepage()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/aptekarz/home');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Witaj,', $crawler->filter('h1')->text());
        $this->assertContains('Ostatnie powiadomienia:', $crawler->filter('h3')->text());
    }

    public function testRecepty()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/aptekarz/recepty');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Wyszukaj receptę', $crawler->filter('h1')->text());
        $this->assertEquals(
            1,
            $crawler->filter('input')->count()
        );
    }

    public function testMagazyn()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/aptekarz/magazyn');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Dostępne leki', $crawler->filter('h1')->text());
        $this->assertEquals(
            1,
            $crawler->filter('table')->count()
        );
    }

    public function testLeki()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/aptekarz/leki');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Wyszukaj lek', $crawler->filter('h1')->text());
        $this->assertEquals(
            1,
            $crawler->filter('input')->count()
        );
    }
}
