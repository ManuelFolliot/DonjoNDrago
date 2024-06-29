<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use App\Repository\CampaignRepository;
use App\Repository\UserRepository;

// Route pour la page d'administration
#[Route('/admin')]
#[IsGranted('ROLE_ADMIN', statusCode: 403)]
class AdminController extends AbstractController
{

   
    #[Route('/campaign', name: 'app_campaign_index', methods: ['GET'])]
    public function indexCampaign(CampaignRepository $campaignRepository): Response
    {
            return $this->render('campaign/index.html.twig', [
                'campaigns' => $campaignRepository->findAll()
            ]);
    }

    #[Route('/user', name: 'app_user_index', methods: ['GET'])]
    public function indexUser(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }
}
