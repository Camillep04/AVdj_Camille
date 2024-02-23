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
        $tabMotCles = [];
        for ($i = 0; $i < 26; $i++) {
            $motcles = new MotCles();
            $motcles->setMotCles($mot[$i]);
            $tabMotCles[] = $motcles;
            $manager->persist($motcles);
        }
        
        for ($i = 0; $i < 15; $i++) {
            $marquepage = new MarquePage();
            $marquepage->setDateCreation(new \DateTime(mt_rand(1975, 2020)));
            $marquepage->setUrl("monUrl".$i);
            $marquepage->setCommentaire("monCommentaire".$i);

            // Aide de Cyan
            for ($j =0; $j < (mt_rand(2, 5)); $j++) {
                $marquepage->addMotCle($tabMotCles[mt_rand(0, 24)]);
            }

            $manager->persist($marquepage);
        }
        $manager->flush();
    }
}
