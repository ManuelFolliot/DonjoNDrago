<?php

namespace App\Controller;

use App\Entity\Character;
use App\Form\CharacterType;
use App\Repository\CharacterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;

#[Route('/hero')]
#[IsGranted('USER_ACCESS')]
class CharacterController extends AbstractController
{
    #[IsGranted('ROLE_ADMIN', statusCode: 403)]
    #[Route('/admin/hero', name: 'app_hero_index', methods: ['GET'])]
    public function index(CharacterRepository $characterRepository): Response
    {
        return $this->render('character/index.html.twig', [
            'characters' => $characterRepository->findAll(),
        ]);
    }


    #[Route('/new', name: 'app_hero_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator): Response
    {

        // On crée un nouveau personnage via le formulaire
            $character = new Character();
            $form = $this->createForm(CharacterType::class, $character);
            $form->handleRequest($request);

            // Si le formulaire est soumis et valide on lui ajoute le user et on l'enregistre
            if ($form->isSubmitted() && $form->isValid()) {
                $character->setLevel(1);
                $character->setLifepoints(20);
                $character->setUser($this->getUser());
                $entityManager->persist($character);
                $entityManager->flush();

                // Redirection vers la page de profil
                return $this->redirectToRoute('app_hero_show', ['id' => $character->getId()], Response::HTTP_SEE_OTHER);
            }

        return $this->render('character/new.html.twig', [
            'character' => $character,
            'form' => $form,
        ]);
    }

    // On ajoute une route pour afficher un personnage
    #[Route('/{id<\d+>}', name: 'app_hero_show', methods: ['GET'])]
    #[IsGranted('USER_ACCESS')]
    public function show(Character $character): Response
    {

            return $this->render('character/show.html.twig', [
                'character' => $character,
            ]);

    }

    #[Route('/{id<\d+>}/edit', name: 'app_hero_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Character $character, EntityManagerInterface $entityManager): Response
    {
            $form = $this->createForm(CharacterType::class, $character);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager->flush();

                return $this->redirectToRoute('app_profil', [], Response::HTTP_SEE_OTHER);
            }

            return $this->render('character/edit.html.twig', [
                'character' => $character,
                'form' => $form,
            ]);
    }

    #[Route('/{id<\d+>}', name: 'app_hero_delete', methods: ['POST'])]
    public function delete(Request $request, Character $character, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $character->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($character);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_profil', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id<\d+>}/stats', name: 'app_hero_stats', methods: ['GET'])]
    public function stats(Character $character): Response
    {
        return $this->render('campaign/actions/stats.html.twig', [
                'character' => $character,
            ]);
    }

}
