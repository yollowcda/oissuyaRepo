<?php

namespace App\Controller;

use App\Entity\VinylMix;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use function Symfony\Component\String\u;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MixController extends AbstractController
{
    #[Route('/mix/new', name: 'new')]
    public function mixController(EntityManagerInterface $eM): Response
    {
        $mix = new VinylMix;
        $genre = array('Pop', 'Rock', 'Heavy_Metal', 'Zouk', 'Soul', 'Jazz');
        $mix->setTitle('Titre de mon mix')
            ->setDescription('La description de mon mix')
            ->setTitle('This is my title')
            ->setGenre($genre[array_rand($genre)])
            ->setVote(rand(-10, 10))
            ->setTrackCount(rand(1, 100));

        $eM->persist($mix);

        //Method to persist all data manages
        $eM->flush();

        dd($mix);
        return new Response();
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




    #[Route('mix/{id}', name: 'mix')]
    public function show(VinylMix $mix): Response
    {
        return $this->render('mix/show.html.twig', ['mix' => $mix]);
    }

    #[Route('/mix/{id}/vote', name: 'mix_vote', methods: ['POST'])]
    public function vote(VinylMix $mix, Request $request, EntityManagerInterface $em): Response
    {
        if($request->request->get('direction') == 'up'){
            $mix->setVote($mix->getVote() + 1);
        }else{
            $mix->setVote($mix->getVote() - 1);
        }
        
        $em->flush();
        $this->addFlash('success', "Votre vote a bien été enregistré");
        return $this->redirectToRoute('mix', ['id' => $mix->getId()]);
    }
}
