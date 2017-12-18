<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PacjentControllerTest extends WebTestCase
{
    public function testHomepage()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/aptekarz/home');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Witaj,', $crawler->filter('h1')->text());
        $this->assertContains('Ostatnie powiadomienia:', $crawler->filter('h3')->text());
    }
    public function testHistoria()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/pacjent/historia');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Twoja historia', $crawler->filter('h1')->text());
    }

    public function testRecepty()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/pacjent/recepty');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Recepty, które nie zostały wydane', $crawler->filter('h1')->text());
    }

    public function testWizyty()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/pacjent/wizyty');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Nadchodzące wizyty', $crawler->filter('h1')->text());
    }

    public function testLekarze()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/pacjent/lekarze');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Twoi lekarze', $crawler->filter('h1')->text());
//        $this->assertContains('Wyszukaj lekarza', $crawler->filter('h1')->text());
        $this->assertEquals(
            1,
            $crawler->filter('input')->count()
        );
    }

    public function testLeki()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/pacjent/leki');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Twoje leki', $crawler->filter('h1')->text());
        $this->assertEquals(
            1,
            $crawler->filter('input')->count()
        );
    }
}
