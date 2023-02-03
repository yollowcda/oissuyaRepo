<?php

namespace App\Controller;

use App\Entity\VinylMix;
use Doctrine\ORM\EntityManagerInterface;
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
            ->setVote(rand(-10,10))
            ->setTrackCount(rand(1,100));
        
        $eM->persist($mix);

        //Method to persist all data manages
        $eM->flush();

        dd($mix);
        return new Response();
    }


    #[Route('mix/{id}', name: 'mix')]
    public function show(EntityManagerInterface $eM, int $idMix = null){
        /** @var VinylMixRepository */
        $repository = $eM->getRepository(VinylMix::class);
        
        /** @var VinylMixRepository */
        $repo = $repository->find($idMix);
        dd($repo);
    }
}
