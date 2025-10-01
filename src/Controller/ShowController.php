<?php

namespace App\Controller;

use App\Entity\Film;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ShowController extends AbstractController
{
    #[Route('/show{id}', name: 'app_show')]
    public function index(Film $film): Response
    {
        return $this->render('show/index.html.twig', [
            'movie' => $film,
        ]);
    }
}
