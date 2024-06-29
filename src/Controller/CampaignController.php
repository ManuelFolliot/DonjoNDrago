<?php

namespace App\Controller;


use App\Entity\Campaign;
use App\Form\CampaignType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Attribute\IsGranted;

// La route pour la page d'accueil des campagnes
#[Route('/campaign')]
#[IsGranted('USER_ACCESS')]
class CampaignController extends AbstractController
{
    // La route pour la page d'accueil des campagnes
    #[Route('/new', name: 'app_campaign_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
            $campaign = new Campaign();
            $form = $this->createForm(CampaignType::class, $campaign);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $campaign->addGameMaster($this->getUser());
                $entityManager->persist($campaign);
                $entityManager->flush();
                
        // Redirection vers la page de profil
                return $this->redirectToRoute('app_profil', [], Response::HTTP_SEE_OTHER);
            }
            
        return $this->render('campaign/new.html.twig', [
            'campaign' => $campaign,
            'form' => $form,
        ]);
    }

    #[Route('/{id<\d+>}', name: 'app_campaign_show', methods: ['GET'])]
    public function show(Campaign $campaign): Response
    {

            return $this->render('campaign/show.html.twig', [
                'campaign' => $campaign,
            ]);

    }

    #[Route('/{id<\d+>}/edit', name: 'app_campaign_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Campaign $campaign, EntityManagerInterface $entityManager): Response
    {

            $form = $this->createForm(CampaignType::class, $campaign);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager->flush();

                return $this->redirectToRoute('app_campaign_index', [], Response::HTTP_SEE_OTHER);
            }

            return $this->render('campaign/edit.html.twig', [
                'campaign' => $campaign,
                'form' => $form,
            ]);
    }

    // La route de suppression de campagne
    #[Route('/{id<\d+>}', name: 'app_campaign_delete', methods: ['POST'])]
    public function delete(Request $request, Campaign $campaign, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $campaign->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($campaign);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_profil', [], Response::HTTP_SEE_OTHER);
    }

    // La route pour afficher les actions de la campagne (dés, ennemies, background, stats, etc.)
    #[Route('/{id<\d+>}/enemies', name: 'app_campaign_enemies', methods: ['GET'])]
    public function enemies(): Response
    {
        return $this->render('campaign/actions/enemies.html.twig', [
        ]);
    }

    #[Route('/{id<\d+>}/dices', name: 'app_campaign_dices', methods: ['GET'])]
    public function dices(): Response
    {
        return $this->render('campaign/actions/dices.html.twig', [
        ]);
    }

    #[Route('/{id<\d+>}/backgrounds', name: 'app_campaign_backgrounds', methods: ['GET'])]
    public function backgrounds(): Response
    {
        return $this->render('campaign/actions/backgrounds.html.twig', [
        ]);
    }

    #[Route('/{id<\d+>}/stats', name: 'app_campaign_stats', methods: ['GET'])]
    public function stats(): Response
    {
        return $this->render('campaign/actions/stats.html.twig', [
        ]);
    }

}
