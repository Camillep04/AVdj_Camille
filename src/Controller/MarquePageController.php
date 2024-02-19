<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\MarquePage;
use App\Entity\MotCles;
use Doctrine\ORM\EntityManagerInterface;



    #[Route("/marque/page", requirements: ["_locale" => "en|es|fr"], name: "app_marque_page_")]
    class MarquePageController extends AbstractController
    {

        #[Route('/', name: 'index')]
        public function index(EntityManagerInterface $entityManager): Response
        {
            $marque_pages = $entityManager->getRepository(MarquePage::class)->findAll();
            return $this->render('marque_page/index.html.twig', [
                'controller_name' => 'MarquePageController',
                'marque_page' => $marque_pages,
            ]);
        }
        #[Route("/ajouter", name: "marquepage_ajouter")]
        public function ajouterMarquePage(EntityManagerInterface $entityManager): Response
        {
            $marquepage = new MarquePage();
            $marquepage->setUrl("mot cle test 2");

            $marquepage->setDateCreation (new \DateTime());
            $marquepage->setCommentaire("nonnon il pleut pas");
            
            $motcles = new MotCles();
            $motcles->setMotCles("test de mot cle 2eme essai");
            $motcles2 = new MotCles();
            $motcles2->setMotCles("test de mot cle 4eme essai");
            $marquepage->addMotCle($motcles);
            $marquepage->addMotCle($motcles2);
            $entityManager->persist($motcles);
            $entityManager->persist($motcles2);
            $entityManager->persist($marquepage);
            $entityManager->flush();
            return new Response("Marque page sauvegardé avec l'id ". $marquepage->getId());
        }
        #[Route("/details/{id<\d+>}", name: "details")]
        public function afficherDetails(int $id, EntityManagerInterface $entityManager): Response
        {
            $details = $entityManager
            ->getRepository(MarquePage::class)
            ->find($id);
            if (!$details) {
                throw $this->createNotFoundException(
                "Aucun details avec l'id ". $id
                );
            }
            
            return $this->render('marque_page/details.html.twig', [
                'details' => $details,
            ]);
        } 
    }  
