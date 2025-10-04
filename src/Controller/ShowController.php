<?php

namespace App\Controller;

use App\Entity\Film;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ShowController extends AbstractController
{
    #[Route('/show/watched', name: 'app_watched')]
    public function watched(EntityManagerInterface $em): Response
    {
        $repo= $em->getRepository(Film::class);
        $movie= $repo->findBy(['isWatched' => true]);

        $nbMovies = count($movie);

        return $this->render('show/watched.html.twig', [
            'movie' => $movie,
            'nbMovies' => $nbMovies,
        ]);
    }

    #[Route('/show/toWatch', name: 'app_toWatch')]
    public function toWatch(EntityManagerInterface $em): Response
    {
        $repo= $em->getRepository(Film::class);
        $movie= $repo->findBy(['isWatched' => false]);

        $nbMovies = count($movie);

        return $this->render('show/toWatch.html.twig', [
            'movie' => $movie,
            'nbMovies' => $nbMovies,
        ]);
    }

    #[Route('/show/top5', name: 'app_top5')]
    public function top5(EntityManagerInterface $em): Response
    {
        $repo= $em->getRepository(Film::class);
        $movie= $repo->findTop5Rated();

        if (empty($movie)) {
        // Aucun film n'est encore noté
        $message = "Aucun film n'a encore été noté.";
        } else {
            $message = null;
        }

        return $this->render('show/top5.html.twig', [
            'movie' => $movie,
            'message' => $message,
        ]);
    }
}
