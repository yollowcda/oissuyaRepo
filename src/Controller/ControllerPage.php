<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ControllerPage{
    #[Route('/browse/{genre}/{numpage}', name: 'blog_list', requirements: ['numpage' => '\d+'])]
    public function controllerPage(string $genre, string $numpage): Response
    {
        return new Response($genre.'/'.$numpage);
    }
}