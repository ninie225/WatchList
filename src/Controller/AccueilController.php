<?php

namespace App\Controller;

use App\Entity\Film;
use App\Repository\FilmRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Repository\RepositoryFactory;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class AccueilController extends AbstractController
{
    #[Route('/accueil', name: 'app_accueil')]
    public function index(FilmRepository $filmRepo): Response
    {
        $movie = $filmRepo->findAll();
        $nbMovies= count($movie);
        return $this->render('accueil/index.html.twig', [
            'nbMovies' => $nbMovies,
            'movies' => $movie
        ]);
    }
}
