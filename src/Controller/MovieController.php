<?php

namespace App\Controller;

use App\Entity\Film;
use App\Form\MovieFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class MovieController extends AbstractController
{
    #[Route('/movie/{id}', name: 'app_movie')]
    public function index(Request $request, Film $movie, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(MovieFormType::class, $movie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($movie);
            $em->flush();
        
            return $this->redirectToRoute('app_accueil');
        }
        return $this->render('rate/index.html.twig', [
            'form' => $form,
        ]);
    }
}
