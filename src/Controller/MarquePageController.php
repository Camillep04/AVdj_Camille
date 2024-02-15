<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\MarquePage;
use Doctrine\ORM\EntityManagerInterface;



    #[Route("/marque/page", requirements: ["_locale" => "en|es|fr"], name: "app_marque_page_")]
    class MarquePageController extends AbstractController
    {

        #[Route('/', name: 'app_marque_page')]
        public function index(EntityManagerInterface $entityManager): Response
        {
            $marque_pages = $entityManager->getRepository(MarquePage::class)->findAll();
            return $this->render('marque_page/index.html.twig', [
                'controller_name' => 'MarquePageController',
                'marque_page' => $marque_pages,
            ]);
        }
        #[Route("/marquepage/ajouter", name: "marquepage_ajouter")]
        public function ajouterMarquePage(EntityManagerInterface $entityManager): Response
        {
            $marquepage = new MarquePage();
            $marquepage->setUrl("https://www.meteo.nc/");

            $marquepage->setDateCreation (new \DateTime());
            $marquepage->setCommentaire("ouioui il pleut");
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
