<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Livre;
use App\Entity\MotClesLivre;
use Doctrine\ORM\EntityManagerInterface;

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
}
