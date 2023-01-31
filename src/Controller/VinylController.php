<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\u;
use Twig\Environment;

class VinylController extends AbstractController{

    #[Route('/', name: 'app_homepage')]
    public function homepage(Environment $env): Response
    {
        
        $html = $env->render('/vinyl/homepage.html.twig',[
        'title'  => 'Crazy frog',
        'tab' => $this->getSongsTitles(),
        ]);
    
        
        return new Response($html);
    }
    private function getSongsTitles() : array {
        $tableau =[
        ['song' => 'Gangsta\'s Paradise', 'artist' => 'Coolio'], 
        ['song' => 'Waterfalls', 'artist' => 'TLC'], 
        ['song' => 'Creep', 'artist' => 'Radiohead'], 
        ['song' => 'Kiss from a Rose', 'artist' => 'Seal'], 
        ['song' => 'On Bended Knee', 'artist' => 'Boyz II Men'], 
        ['song' => 'Fantasy', 'artist' => 'Mariah Carey'],
        ];
        return $tableau;
    }
    private function getMixes(): array 
    { 
        return [
            [
                'title' => 'PB & Jams', 
                'trackCount' => 14, 
                'genre' => 'Rock', 
                'createdAt' => new \DateTime('2021-10-02'), 
            ], 
            [
                'title' => 'Put a Hex on your Ex', 
                'trackCount' => 8, 
                'genre' => 'Heavy Metal', 
                'createdAt' => new \DateTime('2022-04-28'), 
            ], 
            [
                'title' => 'Spice Grills - Summer Tunes', 
                'trackCount' => 10, 
                'genre' => 'Pop', 
                'createdAt' => new \DateTime('2019-06-20'), 
            ], 
        ]; 
    } 




    #[Route('/browse', name: 'browse')]
    public function browse(): Response
    {
        $response = new Response();
        $response->setContent("Tous les genres");
        return $response;
    }


    #[Route('/browse/{slug}', name: 'app_randomGenre')]
    public function randomGenre(string $slug= null): Response
    {
        $genre = $slug ? u(str_replace('-', ' ', $slug))->title(true) : null; 
        return $this->render('vinyl/browse.html.twig',
        [
            'genre' => $genre,
            'mix' => $this->getMixes(),
        ]
    ); 
    }
}