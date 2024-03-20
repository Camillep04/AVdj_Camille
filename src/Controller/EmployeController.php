<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Employe;
use App\Entity\Adresse;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\Type\EmployeType;
use App\Repository\EmployeRepository;
use Symfony\Component\HttpFoundation\Request;

#[Route("/employe", requirements: ["_locale" => "en|es|fr"], name: "app_employe_")]
class EmployeController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $employe = $entityManager->getRepository(Employe::class)->findAll();
        return $this->render('employe/index.html.twig', [
            'controller_name' => 'EmployeController',
            'employe' => $employe,
        ]);
    }
    #[Route("/detailsemploye/{id<\d+>}", name: "detailsemploye")]
        public function afficherDetailsEmploye(int $id, EntityManagerInterface $entityManager): Response
        {
            $detailsemploye = $entityManager
            ->getRepository(Employe::class)
            ->find($id);
            if (!$detailsemploye) {
                throw $this->createNotFoundException(
                "Aucun details employe avec l'id ". $id
                );
            }
            
            return $this->render('employe/details_employe.html.twig', [
                'detailsemploye' => $detailsemploye,
            ]);
        }
    #[Route("/ajout", name:"employe_ajout")]
        public function ajout(Request $request, ManagerRegistry $doctrine)
        {
            $employe = new Employe();
            $form = $this->createForm(EmployeType::class, $employe);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                // $form->getData() : pour récupérer les données
                // Les données sont déjà stockées dans la variable d’origine
                // $employe = $form->getData();
                // ... Effectuer le/les traitements(s) à réaliser
                // Par exemple :
                $entityManager = $doctrine->getManager();
                $entityManager->persist($employe);
                $entityManager->flush();
                return $this->redirectToRoute('app_employe_ajout_succes');
            }
        return $this->render('employe/ajout.html.twig', [
            'form' => $form,
        ]);
    }
    #[Route('/succes', name: 'ajout_succes')]
    public function succes(): Response
    {
        return $this->render('employe/ajout_succes.html.twig');
    }
    #[Route('/modifier/{id}', name: 'employe_modifier')]
    public function modifierEmploye(int $id, Request $request, EntityManagerInterface $entityManager, EmployeRepository $employeRepository): Response
    {
        $employe = $employeRepository->find($id);

        if (!$employe) {
            throw $this->createNotFoundException("Employe non trouvé avec l'identifiant : " . $id);
        }

        $form = $this->createForm(EmployeType::class, $employe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_employe_ajout_succes', ['id' => $id]);
        }

        return $this->render('employe/modifier.html.twig', [
            'form' => $form->createView(),
            'employe' => $employe,
        ]);
    }
}
