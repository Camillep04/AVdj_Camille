<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Livre;
use App\Entity\Auteur;

class FixturesLivre extends Fixture
{
        // $product = new Product();
        // $manager->persist($product);
        public function load(ObjectManager $manager)
        {
        // Création de 15 livres
            for ($i = 0; $i < 15; $i++) {
                $auteur = new Auteur();
                $auteur->setNom("Nom".$i);
                $auteur->setPrenom("Prénom".$i);

                $livre = new Livre();
                $livre->setDate(new \DateTime(mt_rand(1975, 2020)));
                $livre->setTitre('Livre '.$i);
                $livre->setPage(mt_rand(45, 1500));
                $livre->setAuteur($auteur); // Mise en relation des deux objets

                $manager->persist($livre);
                $manager->persist($auteur);
            }
            $manager->flush();
        }
}
