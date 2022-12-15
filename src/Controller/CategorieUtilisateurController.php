<?php

namespace App\Controller;

use App\Entity\CategorieUtilisateur;
use App\Form\CategorieUtilisateurType;
use App\Repository\CategorieUtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/categorie/utilisateur')]
class CategorieUtilisateurController extends AbstractController
{
    #[Route('/', name: 'app_categorie_utilisateur_index', methods: ['GET'])]
    public function index(CategorieUtilisateurRepository $categorieUtilisateurRepository): Response
    {
        return $this->render('categorie_utilisateur/index.html.twig', [
            'categorie_utilisateurs' => $categorieUtilisateurRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_categorie_utilisateur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CategorieUtilisateurRepository $categorieUtilisateurRepository): Response
    {
        $categorieUtilisateur = new CategorieUtilisateur();
        $form = $this->createForm(CategorieUtilisateurType::class, $categorieUtilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categorieUtilisateurRepository->save($categorieUtilisateur, true);

            return $this->redirectToRoute('app_categorie_utilisateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categorie_utilisateur/new.html.twig', [
            'categorie_utilisateur' => $categorieUtilisateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_categorie_utilisateur_show', methods: ['GET'])]
    public function show(CategorieUtilisateur $categorieUtilisateur): Response
    {
        return $this->render('categorie_utilisateur/show.html.twig', [
            'categorie_utilisateur' => $categorieUtilisateur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_categorie_utilisateur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CategorieUtilisateur $categorieUtilisateur, CategorieUtilisateurRepository $categorieUtilisateurRepository): Response
    {
        $form = $this->createForm(CategorieUtilisateurType::class, $categorieUtilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categorieUtilisateurRepository->save($categorieUtilisateur, true);

            return $this->redirectToRoute('app_categorie_utilisateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categorie_utilisateur/edit.html.twig', [
            'categorie_utilisateur' => $categorieUtilisateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_categorie_utilisateur_delete', methods: ['POST'])]
    public function delete(Request $request, CategorieUtilisateur $categorieUtilisateur, CategorieUtilisateurRepository $categorieUtilisateurRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categorieUtilisateur->getId(), $request->request->get('_token'))) {
            $categorieUtilisateurRepository->remove($categorieUtilisateur, true);
        }

        return $this->redirectToRoute('app_categorie_utilisateur_index', [], Response::HTTP_SEE_OTHER);
    }
}
