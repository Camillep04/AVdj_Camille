<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AcueilController extends AbstractController
{
    #[Route('/', name: 'app_acueil')]
    public function index(): Response
    {
        return $this->render('acueil/index.html.twig', [
            'controller_name' => 'AcueilController',
        ]);
    }
}
