<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\MarquePage;
use App\Entity\MotCles;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityManager;
use App\Form\Type\MarquePageType;
use App\Form\Type\MotClesType;
use App\Repository\MarquePageRepository;
use Symfony\Component\HttpFoundation\Request;

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
        // #[Route("/ajouter", name: "marquepage_ajouter")]
        // public function ajouterMarquePage(EntityManagerInterface $entityManager): Response
        // {
        //     $marquepage = new MarquePage();
        //     $marquepage->setUrl("mot cle test 2");

        //     $marquepage->setDateCreation (new \DateTime());
        //     $marquepage->setCommentaire("nonnon il pleut pas");
            
        //     $motcles = new MotCles();
        //     $motcles->setMotCles("test de mot cle 2eme essai");
        //     $motcles2 = new MotCles();
        //     $motcles2->setMotCles("test de mot cle 4eme essai");
        //     $marquepage->addMotCle($motcles);
        //     $marquepage->addMotCle($motcles2);
        //     $entityManager->persist($motcles);
        //     $entityManager->persist($motcles2);
        //     $entityManager->persist($marquepage);
        //     $entityManager->flush();
        //     return new Response("Marque page sauvegardé avec l'id ". $marquepage->getId());
        // }
        #[Route("/details/{id<\d+>}", name: "details")]
        public function afficherDetails(int $id, EntityManagerInterface $entityManagerInterface): Response
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
        #[Route("/rubrique", name: "rubrique")]
        public function afficherRubrique(EntityManagerInterface $entityManagerInterface): Response
        {
            return $this->render('marque_page/rubrique.html.twig');
        } 

        private $entityManager;

        public function __construct(EntityManagerInterface $entityManager)
        {
            $this->entityManager = $entityManager;
        }
        #[Route("/ajout", name:"marque_page_ajout")]
            public function ajout(Request $request)
            {
                $marque_pages = new MarquePage();
                $form = $this->createForm(MarquePageType::class, $marque_pages);
                $form->handleRequest($request);
                
                if ($form->isSubmitted() && $form->isValid()) {
                    $this->entityManager->persist($marque_pages);
                    $this->entityManager->flush();
                    return $this->redirectToRoute('app_marque_page_ajout_succes');
                } 
                return $this->render('marque_page/ajout.html.twig', [
                    'form' => $form->createView(),
                ]);
            }
        #[Route('/succes', name: 'ajout_succes')]
        public function succes(): Response
        {
            return $this->render('marque_page/ajout_succes.html.twig');
        }
        #[Route('/modifier/{id}', name: 'marque_page_modifier')]
        public function modifierMarquePage(int $id, Request $request, EntityManagerInterface $entityManager, MarquePageRepository $marquePageRepository): Response
        {
            $marquePage = $marquePageRepository->find($id);

            if (!$marquePage) {
                throw $this->createNotFoundException("Marque Page non trouvé avec l'identifiant : " . $id);
            }

            $form = $this->createForm(MarquePageType::class, $marquePage);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager->flush();

                return $this->redirectToRoute('app_marquePage_ajout_succes', ['id' => $id]);
            }

            return $this->render('marque_page/modifier.html.twig', [
                'form' => $form->createView(),
                'marquePage' => $marquePage,
            ]);
        }   
    }  
