<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Employe;
use App\Entity\Adresse;

class FixturesEmploye extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        // Création de 15 employés et adresses
        for ($i = 0; $i < 15; $i++) {
            $employe = new Employe();
            $employe->setNom("Nom".$i);
            $employe->setPrenom("Prénom".$i);
            $employe->setStatut("Statut".$i);

            $adresse = new Adresse();
            $adresse->setPays("Pays".$i);
            $adresse->setVille("Ville".$i);
            $adresse->setRue("Rue".$i);
            $adresse->setCodePostal($i);
            $employe->setAdresse($adresse); // Mise en relation des deux objets

            $manager->persist($employe);
            $manager->persist($adresse);
        }
        $manager->flush();
    }
}
