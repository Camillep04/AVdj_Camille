<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Faune;
use App\Entity\Flore;
use Doctrine\ORM\EntityManagerInterface;


#[Route("/caillou", requirements: ["_locale" => "en|es|fr"], name: "app_caillou_")]
class CaillouController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('caillou/index.html.twig', [
            'controller_name' => 'CaillouController',
        ]);
    }
    #[Route("/faune", name: "faune")]
        public function afficherFaune(EntityManagerInterface $entityManager): Response
        {
            $faune = $entityManager
            ->getRepository(Faune::class)
            ->findAll();            
            return $this->render('caillou/faune.html.twig', [
                'faune' => $faune,
            ]);
        } 
    #[Route("/flore", name: "flore")]
        public function afficherFlore(EntityManagerInterface $entityManager): Response
        {
            $flore = $entityManager
            ->getRepository(Flore::class)
            ->findAll();            
            return $this->render('caillou/flore.html.twig', [
                'flore' => $flore,
            ]);
        } 
}
