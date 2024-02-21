<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\MarquePage;
use App\Entity\MotCles;

class FixturesMarquePage extends Fixture
{
        // $product = new Product();
        // $manager->persist($product);

    public function load(ObjectManager $manager)
    {
        $mot = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
        // Création de 15 livres
        for ($i = 0; $i < 26; $i++) {
            $motcles = new MotCles();
            $motcles->setMotCles($mot[$i]);
            $manager->persist($motcles);
        }
        
        for ($i = 0; $i < 15; $i++) {
            $marquepage = new MarquePage();
            $marquepage->setDate(new \DateTime(mt_rand(1975, 2020)));
            $marquepage->setUrl();
            $marquepage->setCommentaire();
            $manager->persist($marquepage);
        }
        $manager->flush();
    }
}
