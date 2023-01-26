<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VinylController{

    #[Route('/', name: 'homepage')]
    public function homepage(): Response
    {
        //$variable = "oissuya print test";
        //dd($variable);
        return new Response('PHP EIYUU');
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