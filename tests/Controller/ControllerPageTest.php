<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ControllerPageTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        //$this->assertResponseIsSuccessful();
        //$this->assertSelectorTextContains('h1', 'Hello World');
        $genre = "genretest";
        $numeroPage = 6;
        $client->request('GET', "/browse/{$genre}/{$numeroPage}");
        $response = $client->getResponse();
        $this->assertTrue($response->getContent() === $genre.'/'.$numeroPage);
    }
}
