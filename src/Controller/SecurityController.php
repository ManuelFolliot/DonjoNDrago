<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    // Route pour la page de connexion
    #[Route(path: '/login', name: 'app_login', methods: ['GET', "POST"])]
    // On crée une méthode pour se log qui prend en paramètre AuthenticationUtils
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_profil', ['id' => $this->getUser()]);
        }

        // si l'utilisateur est déjà connecté on le redirige vers la page de profil
        $error = $authenticationUtils->getLastAuthenticationError();
        // si l'utilisateur n'est pas connecté on lui affiche le formulaire de connexion
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }
}
