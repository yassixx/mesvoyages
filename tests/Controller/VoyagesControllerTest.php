<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
/**
 * Description of VoyagesControllerTest
 *
 * @author intad
 */
class VoyagesControllerTest extends WebTestCase{
    //put your code here
    public function testAccesPage(){
        $client = static::createClient();
        $client->request('GET', '/voyages');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
    
     public function testContenuPage(){
        $client = static::createClient();
        $crawler = $client->request('GET', '/voyages');
        $this->assertSelectorTextContains('h1', 'Mes voyages');
        $this->assertSelectorTextContains('th', 'Ville');
        $this->assertCount(4, $crawler->filter('th'));
        $this->assertSelectorTextContains('h5', 'Leger');
    }
    
     public function testLinkVille(){
        $client = static::createClient();
        $client->request('GET', '/voyages');
        // clic sur le lien (le nom d'une ville)
        $client->clickLink('Leger');
        // récupération du résultat du clic
        $response = $client->getResponse();
        // contrôle si le client existe
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        // récupération de la route et contrôle qu'elle est correcte
        $uri = $client->getRequest()->server->get('REQUEST_URI');
        $this->assertEquals('/voyages/voyage/46', $uri);
        $response = $client->getResponse();
        dd($client->getRequest());
    }

    public function testFiltreVille(){
        $client = static::createClient();
        $client->request('GET', '/voyages');
        // simulation de la soumission du formaulaire
        $crawler = $client->submitForm('filtrer', [
            'recherche' => 'Coulon'
        ]);
        // vérifie le nombre de lignes obtenues
        $this->assertCount(1, $crawler->filter('h5'));
        // vérifie si la ville correspond à la recherche
        $this->assertSelectorTextContains('h5', 'Coulon');
    }
}
