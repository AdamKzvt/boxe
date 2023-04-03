<?php

namespace App\Controller;

use App\Entity\Boxeur;
use App\Form\BoxeurType;
use App\Repository\BoxeurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/boxeur')]
class BoxeurController extends AbstractController
{
    #[Route('/', name: 'app_boxeur_index', methods: ['GET'])]
    public function index(BoxeurRepository $boxeurRepository): Response
    {
        return $this->render('boxeur/index.html.twig', [
            'boxeurs' => $boxeurRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_boxeur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BoxeurRepository $boxeurRepository): Response
    {
        $boxeur = new Boxeur();
        $form = $this->createForm(BoxeurType::class, $boxeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $boxeurRepository->save($boxeur, true);

            return $this->redirectToRoute('app_boxeur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('boxeur/new.html.twig', [
            'boxeur' => $boxeur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_boxeur_show', methods: ['GET'])]
    public function show(Boxeur $boxeur): Response
    {
        return $this->render('boxeur/show.html.twig', [
            'boxeur' => $boxeur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_boxeur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Boxeur $boxeur, BoxeurRepository $boxeurRepository): Response
    {
        $form = $this->createForm(BoxeurType::class, $boxeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $boxeurRepository->save($boxeur, true);

            return $this->redirectToRoute('app_boxeur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('boxeur/edit.html.twig', [
            'boxeur' => $boxeur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_boxeur_delete', methods: ['POST'])]
    public function delete(Request $request, Boxeur $boxeur, BoxeurRepository $boxeurRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$boxeur->getId(), $request->request->get('_token'))) {
            $boxeurRepository->remove($boxeur, true);
        }

        return $this->redirectToRoute('app_boxeur_index', [], Response::HTTP_SEE_OTHER);
    }
}
