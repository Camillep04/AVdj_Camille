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


#[Route("/livre", requirements: ["_locale" => "en|es|fr"], name: "app_livre_")]
class LivreController extends AbstractController
{
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
    #[Route("/recherche/livre-lettre/{lettre}", name: "livrelettre")]
    public function livreLettre($lettre, EntityManagerInterface $entityManager)
    {
        $listeLivres = $entityManager
        ->getRepository(Livre::class)
        ->findLivreLettre($lettre);
        return $this->render('livre/requete_livre_lettre.html.twig', [
            'listeLivres' => $listeLivres,
        ]);
    }

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
}
