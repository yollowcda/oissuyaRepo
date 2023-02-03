<?php

namespace App\Controller;

use Twig\Environment;
use App\Entity\VinylMix;
use App\Repository\VinylMixRepository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use function Symfony\Component\String\u;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class VinylController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function homepage(Environment $env): Response
    {
        $html = $env->render('/vinyl/homepage.html.twig', [
            'title'  => 'Crazy frog',
            'tab' => $this->getSongsTitles(),
        ]);


        return new Response($html);
    }
    private function getSongsTitles(): array
    {
        $tableau = [
            ['song' => 'Gangsta\'s Paradise', 'artist' => 'Coolio'],
            ['song' => 'Waterfalls', 'artist' => 'TLC'],
            ['song' => 'Creep', 'artist' => 'Radiohead'],
            ['song' => 'Kiss from a Rose', 'artist' => 'Seal'],
            ['song' => 'On Bended Knee', 'artist' => 'Boyz II Men'],
            ['song' => 'Fantasy', 'artist' => 'Mariah Carey'],
        ];
        return $tableau;
    }


    #[Route('/browse/{slug}', name: 'app_randomGenre')]
    public function randomGenre(EntityManagerInterface $em, string $slug = null): Response
    {
        /** @var VinylMixRepository */
        $repository = $em->getRepository(VinylMix::class);
        //dd($slug);
        $a = $repository->filterByGenre($slug);
        $genre = $slug ? u(str_replace('-', ' ', $slug))->title(true) : null;

        return $this->render(
            'vinyl/browse.html.twig',
            [
                'genre' => $genre,
                'mix' => $a,
            ]
        );
    }
}
