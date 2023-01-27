<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VinylController extends AbstractController{

    #[Route('/', name: 'homepage')]
    public function homepage(): Response
    {
        return($this->render('/vinyl/homepage.html.twig',[
            'title'  => 'Crazy frog',
            'tab' => $this->getSongsTitles()
        ]));
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




    #[Route('/browse', name: 'browse')]
    public function browse(): Response
    {
        $response = new Response();
        $response->setContent("Tous les genres");
        return $response;
    }


    #[Route('/browse/{slug}', name: 'randomGenre')]
    public function randomGenre(string $slug): Response
    {
        return new Response($slug);
    }
}