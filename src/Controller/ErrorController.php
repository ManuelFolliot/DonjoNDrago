<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ErrorController extends AbstractController
{
    // Route pour la page d'erreur
    #[Route('/error', name: 'app_error')]
    public function index(): Response
    {
        return $this->render('error/error.html.twig', [
            'controller_name' => 'ErrorController',
        ]);
    }
}
