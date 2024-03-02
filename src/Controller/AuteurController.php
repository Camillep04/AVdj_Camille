<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Auteur;
use App\Entity\Livre;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\AuteurRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\Type\AuteurType;
use Symfony\Component\HttpFoundation\Request;

#[Route("/auteur", requirements: ["_locale" => "en|es|fr"], name: "app_auteur_")]
class AuteurController extends AbstractController
{
    #[Route('/', name: 'app_auteur')]
    public function index(): Response
    {
        return $this->render('auteur/index.html.twig', [
            'controller_name' => 'AuteurController',
        ]);
    }

    // requete pour afficher les nom, prenom des auteurs qui ont écrit plus de ... livre(s)
    #[Route("/recherche/auteur/{nbLivre}", name: "auteur")]
    public function auteur($nbLivre, EntityManagerInterface $entityManager)
    {
        $livreAuteur = $entityManager
        ->getRepository(Livre::class)
        ->findAuteur($nbLivre);
        return $this->render('auteur/requete_nbLivre.html.twig', [
            'livreAuteur' => $livreAuteur,
        ]);
    }

    // ajouter un auteur via un formulaire
    #[Route("/ajout-auteur", name:"auteur_ajout")]
    public function ajoutAuteur(Request $request, ManagerRegistry $doctrine)
    {
        // Création d’un objet Auteur vierge
        $auteur = new Auteur();
        $form = $this->createForm(AuteurType::class, $auteur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() : pour récupérer les données
            // Les données sont déjà stockées dans la variable d’origine
            // $auteur = $form->getData();
            // ... Effectuer le/les traitements(s) à réaliser
            // Par exemple :
            $entityManager = $doctrine->getManager();
            $entityManager->persist($auteur);
            $entityManager->flush();
            return $this->redirectToRoute('app_auteur_auteur_ajout_succes');
        }
        return $this->render('auteur/ajout.html.twig', [
            'form' => $form,
        ]);
    }
    #[Route('/succes-auteur', name: 'auteur_ajout_succes')]
    public function succesAuteur(): Response
    {
        return $this->render('auteur/ajout_succes.html.twig');
    }

    //modifier nom prenom auteur via un formulaire pré rempli
    #[Route('/modifier/{id}', name: 'auteur_modifier')]
    public function modifierAuteur(int $id, Request $request, EntityManagerInterface $entityManager, AuteurRepository $auteurRepository): Response
    {
        $auteur = $auteurRepository->find($id);

        if (!$auteur) {
            throw $this->createNotFoundException("Auteur non trouvé avec l'identifiant : " . $id);
        }

        $form = $this->createForm(AuteurType::class, $auteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_auteur_auteur_ajout_succes', ['id' => $id]);
        }

        return $this->render('auteur/modifier.html.twig', [
            'form' => $form->createView(),
            'auteur' => $auteur,
        ]);
    }
}
