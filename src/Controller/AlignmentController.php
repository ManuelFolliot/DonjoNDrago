<?php

namespace App\Controller;

use App\Entity\Alignment;
use App\Form\AlignmentType;
use App\Repository\AlignmentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/alignment')]
class AlignmentController extends AbstractController
{
    #[Route('/', name: 'app_alignment_index', methods: ['GET'])]
    public function index(AlignmentRepository $alignmentRepository): Response
    {
        return $this->render('alignment/index.html.twig', [
            'alignments' => $alignmentRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_alignment_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $alignment = new Alignment();
        $form = $this->createForm(AlignmentType::class, $alignment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($alignment);
            $entityManager->flush();

            return $this->redirectToRoute('app_alignment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('alignment/new.html.twig', [
            'alignment' => $alignment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_alignment_show', methods: ['GET'])]
    public function show(Alignment $alignment): Response
    {
        return $this->render('alignment/show.html.twig', [
            'alignment' => $alignment,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_alignment_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Alignment $alignment, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AlignmentType::class, $alignment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_alignment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('alignment/edit.html.twig', [
            'alignment' => $alignment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_alignment_delete', methods: ['POST'])]
    public function delete(Request $request, Alignment $alignment, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$alignment->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($alignment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_alignment_index', [], Response::HTTP_SEE_OTHER);
    }
}
