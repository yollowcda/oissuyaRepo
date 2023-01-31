<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Psr\Log\LoggerInterface;

class SongApiController extends AbstractController
{
    #[Route('/api/song/{id<\d+>}', name: 'app_song_api', methods: 'GET')]
    public function index(LoggerInterface $logI, string $id): Response
    {
        $song = [
            'id' => $id,
            'name' => 'Waterfalls',
            'url' => 'https://symfonycasts.s3.amazonaws.com/sample.mp3',
        ];
        $logI->info('Returning API response for song'.$id);
        return new JsonResponse($song);
    }
}
