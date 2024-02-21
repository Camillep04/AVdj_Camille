<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Livre;

class FixturesLivre extends Fixture
{
        // $product = new Product();
        // $manager->persist($product);
        public function load(ObjectManager $manager)
        {
        // Création de 15 livres
            for ($i = 0; $i < 15; $i++) {
                $livre = new Livre();
                $livre->setDate(new \DateTime(mt_rand(1975, 2020)));
                $livre->setTitre('Livre '.$i);
                $livre->setPage(mt_rand(45, 1500));
                $manager->persist($livre);
            }
            $manager->flush();
        }
}
