<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\MarquePage;
use Doctrine\ORM\EntityManagerInterface;

class MarquePageController extends AbstractController
{
    #[Route('/marque/page', name: 'app_marque_page')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $marque_pages = $entityManager->getRepository(MarquePage::class)->findAll();
        return $this->render('marque_page/index.html.twig', [
            'controller_name' => 'MarquePageController',
            'marque_page' => $marque_pages,
        ]);
    }
}
