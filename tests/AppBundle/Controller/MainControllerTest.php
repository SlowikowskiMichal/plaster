<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MainControllerTest extends WebTestCase
{
    public function loginPageSouldContainFieldLoginAndPassword()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/zaloguj');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Login")')->count()
        );
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Password")')->count()
        );
    }

    public function topNavBarShouldContainFieldsZalogujAndAboutOnZalogujPage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/zaloguj');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Zaloguj")')->count()
        );
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("About")')->count()
        );
    }

    public function testAboutPage()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/about');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('O projekcie', $crawler->filter('h1')->text());
    }

    public function topNavBarShouldContainFieldsZalogujAndAboutOnAboutPage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/about');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Zaloguj")')->count()
        );
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("About")')->count()
        );
    }
}
