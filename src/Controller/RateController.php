<?php

namespace App\Controller;

use App\Entity\Film;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RateController extends AbstractController
{
    #[Route('/rate/{id}', name: 'app_rate')]
    public function index(Request $request, Film $movie, EntityManagerInterface $em): Response
    {
        if ($request->isMethod('POST')) {
            // 1. Récupérer la case Vu
            $isWatched = $request->request->get('isWatched') !== null;
            $movie->setIsWatched($isWatched);

            // 2. Si le film est vu → enregistrer la note
            if ($isWatched) {
                $note = $request->request->get('note');
                if ($note !== null) {
                    $movie->setNote((int)$note);
                }
            } else {
                // si pas vu → remettre la note à null
                $movie->setNote(null);
            }

            // 3. Sauvegarder en base
            $em->persist($movie);
            $em->flush();

            $this->addFlash('success', 'Vos modifications ont bien été enregistrées.');

            return $this->redirectToRoute('app_show', ['id' => $movie->getId()]);
        }

        return $this->render('rate/index.html.twig', [
            'movie' => $movie,
        ]);
    }
}
