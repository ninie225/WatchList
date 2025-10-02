<?php

namespace App\Controller;

use App\Entity\Film;
use App\Form\AddMovieFormType;
use App\Form\MovieFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class MovieController extends AbstractController
{
    #[Route('/modify/{id}', name: 'app_modify')]
    public function index(Request $request, Film $movie, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(MovieFormType::class, $movie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($movie);
            $em->flush();
        
            return $this->redirectToRoute('app_accueil');
        }
        return $this->render('modify/index.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'app_delete', methods: ['POST'])]
    public function delete(Request $request, Film $movie, EntityManagerInterface $em): Response {
        if ($this->isCsrfTokenValid('delete'.$movie->getId(), $request->getPayload()->getString('_token'))) {
            $em->remove($movie);
            $em->flush();
        }
        return $this->redirectToRoute('app_accueil', [], Response::HTTP_SEE_OTHER);
    }


    #[Route('/add', name: 'app_add')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $movie = new Film();
        $form = $this->createForm(AddMovieFormType::class, $movie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // dd($movie);
            $movie->setIsWatched(false);

            $file = $form->get('picture')->getData();
            
            $entityManager->persist($movie);
            $entityManager->flush();

            return $this->redirectToRoute('app_accueil', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('modify/add.html.twig', [
            'movie' => $movie,
            'form' => $form,
        ]);
    }
}
