<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CaillouController extends AbstractController
{
    #[Route('/caillou', name: 'app_caillou')]
    public function index(): Response
    {
        return $this->render('caillou/index.html.twig', [
            'controller_name' => 'CaillouController',
        ]);
    }
}
