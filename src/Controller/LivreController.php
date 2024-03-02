<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Livre;
use App\Entity\Auteur;
use App\Entity\MotClesLivre;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\Type\LivreType;
use App\Form\Type\AuteurType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\AuteurRepository;
use App\Repository\LivreRepository;

#[Route("/livre", requirements: ["_locale" => "en|es|fr"], name: "app_livre_")]
class LivreController extends AbstractController
{
    // page accueil de livre
    #[Route('/', name: 'index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $livre = $entityManager->getRepository(Livre::class)->findAll();
        return $this->render('livre/index.html.twig', [
            'controller_name' => 'LivreController',
            'livre' => $livre,
        ]);
    }

    // #[Route("/ajouter", name: "livre_ajouter")]
    //     public function ajouterLivre(EntityManagerInterface $entityManager): Response
    //     {
    //         $livre = new livre();
    //         $livre->setDate (new \DateTime());
    //         $livre->setTitre("La passe mirroir");
    //         $livre->setPage(500);
            
    //         $entityManager->persist($livre);
    //         $entityManager->flush();
    //         return new Response("Livre sauvegardé avec l'id ". $livre->getId());
    //     }

    // affiche les details de livre
    #[Route("/detailslivre/{id<\d+>}", name: "detailslivre")]
        public function afficherDetailsLivre(int $id, EntityManagerInterface $entityManager): Response
        {
            $detailslivre = $entityManager
            ->getRepository(Livre::class)
            ->find($id);
            if (!$detailslivre) {
                throw $this->createNotFoundException(
                "Aucun details livre avec l'id ". $id
                );
            }
            
            return $this->render('livre/details_livre.html.twig', [
                'detailslivre' => $detailslivre,
            ]);
        } 

    // requete pour afficher le nombre de livre en base
    #[Route("/recherche/livre-base", name: "livrebase")]
    public function livreBase(EntityManagerInterface $entityManager)
    {
        $nbLivres = $entityManager
        ->getRepository(Livre::class)
        ->findNbLivreBase();
        return $this->render('livre/requete_livre_base.html.twig', [
            'nbLivres' => $nbLivres,
        ]);
    }

    // requete pour afficher les livre dont la lettre commence par ...
    #[Route("/recherche/livre-lettre/{lettre}", name: "livrelettre")]
    public function livreLettre($lettre, EntityManagerInterface $entityManager)
    {
        $listeLivre = $entityManager
        ->getRepository(Livre::class)
        ->findLivreLettre($lettre);
        return $this->render('livre/requete_livre_lettre.html.twig', [
            'listeLivre' => $listeLivre,
        ]);
    }

    // requete pour afficher les nom, prenom des auteurs qui ont écrit plus de ... livre(s)
    #[Route("/recherche/auteur/{nbLivre}", name: "auteur")]
    public function auteur($nbLivre, EntityManagerInterface $entityManager)
    {
        $livreAuteur = $entityManager
        ->getRepository(Livre::class)
        ->findAuteur($nbLivre);
        return $this->render('livre/requete_livre_nbLivre.html.twig', [
            'livreAuteur' => $livreAuteur,
        ]);
    }

    // ajouter un livre via un formulaire
    #[Route("/ajout", name:"livre_ajout")]
    public function ajout(Request $request, ManagerRegistry $doctrine)
    {
        // Création d’un objet Livre vierge
        $livre = new Livre();
        $form = $this->createForm(LivreType::class, $livre);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() : pour récupérer les données
            // Les données sont déjà stockées dans la variable d’origine
            // $livre = $form->getData();
            // ... Effectuer le/les traitements(s) à réaliser
            // Par exemple :
            $entityManager = $doctrine->getManager();
            $entityManager->persist($livre);
            $entityManager->flush();
            return $this->redirectToRoute('app_livre_livre_ajout_succes');
        }
    return $this->render('livre/ajout.html.twig', [
        'form' => $form,
    ]);
    }

    #[Route('/succes', name: 'livre_ajout_succes')]
    public function succes(): Response
    {
        return $this->render('livre/ajout_succes.html.twig');
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
            return $this->redirectToRoute('app_livre_auteur_ajout_succes');
        }
    return $this->render('livre/ajout.html.twig', [
        'form' => $form,
    ]);
    }

    #[Route('/succes-auteur', name: 'auteur_ajout_succes')]
    public function succesAuteur(): Response
    {
        return $this->render('livre/ajout_succes.html.twig');
    }

    //modifier nom prenom auteur via un formulaire pré rempli
    #[Route('/auteur/modifier/{id}', name: 'auteur_modifier')]
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

            return $this->redirectToRoute('app_livre_auteur_ajout_succes', ['id' => $id]);
        }

        return $this->render('livre/modifier.html.twig', [
            'form' => $form->createView(),
            'auteur' => $auteur,
        ]);
    }

    //modifier titre, page, date livre via un formulaire pré rempli
    #[Route('/modifier/{id}', name: 'livre_modifier')]
    public function modifierLivre(int $id, Request $request, EntityManagerInterface $entityManager, LivreRepository $livreRepository): Response
    {
        $livre = $livreRepository->find($id);

        if (!$livre) {
            throw $this->createNotFoundException("Livre non trouvé avec l'identifiant : " . $id);
        }

        $form = $this->createForm(LivreType::class, $livre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_livre_livre_ajout_succes', ['id' => $id]);
        }

        return $this->render('livre/modifier.html.twig', [
            'form' => $form->createView(),
            'livre' => $livre,
        ]);
    }
}
