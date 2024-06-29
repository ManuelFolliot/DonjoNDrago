<?php

namespace App\Controller;

use App\Repository\CampaignRepository;
use App\Repository\CharacterRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    // Route pour la page d'accueil
    #[Route('/', name: 'app_main')]
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    #[Route('/profil', name: 'app_profil')]
    #[IsGranted('USER_ACCESS')]
    public function profil(CharacterRepository $characterRepository, CampaignRepository $campaignRepository): Response
    {
        /** @var \App\Entity\User **/
        
        // Récupération de l'utilisateur connecté 
        // Récupération des personnages de l'utilisateur connecté
        // Récupération des campagnes où le personnage de l'utilisateur est joueur
        // Récupération des campagnes où l'utilisateur est maître du jeu
        $user = $this->getUser();
        $campaign= $campaignRepository->findByCharacterId($user->getCharacters());
        $campaign= array_merge ($campaign, $campaignRepository->findByGameMasterId($user->getId()));
        return $this->render('profil/profil.html.twig', [
                'characters' => $characterRepository->findByUserId($user->getId()),
                'campaigns' => $campaign, 
            ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[IsGranted('ROLE_ADMIN', statusCode: 403)]
    #[Route('/admin', name: 'app_admin')]
    public function admin(): Response
    {
        return $this->render('main/admin.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
    // Route pour la page de mentions légales
    #[Route(path: '/mentions', name: 'app_mentions')]
    public function mentions(): Response
    {
        return $this->render('main/legal_notice.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

}
