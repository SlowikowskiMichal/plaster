<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LekarzControllerTest extends WebTestCase
{
    public function testHomepage()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/lekarz/home');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Witaj,', $crawler->filter('h1')->text());
        $this->assertContains('Ostatnie powiadomienia:', $crawler->filter('h3')->text());
    }

    public function testPacjenci()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/lekarz/pacjenci');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Wyszukaj pacjenta', $crawler->filter('h1')->text());
    }

    public function testWizyty()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/lekarz/wizyty');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Nadchodzące wizyty', $crawler->filter('h1')->text());
    }

    public function testLeki()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/lekarz/leki');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Lista dostępnych leków', $crawler->filter('h1')->text());
        $this->assertEquals(
            1,
            $crawler->filter('input')->count()
        );
    }
}
