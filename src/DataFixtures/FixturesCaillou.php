<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Caillou;
use App\Entity\Faune;
use App\Entity\Flore;

class FixturesCaillou extends Fixture
{
    public function load(ObjectManager $manager)
        {
        // Création de 15 faune et flore
            for ($i = 0; $i < 15; $i++) {
                $faune = new Faune();
                $faune->setNom('faune '.$i);
                $imageRandom = "https://picsum.photos/100?random=" . $i . "&timestamp=" . time(); // timestamp permet de forcer le navigateur à charger une nouvelle image pour chaque itération
                $faune->setImg($imageRandom);
                $faune->setDescription('animal'.$i);

                $flore = new Flore();
                $flore->setNom('flore '.$i);
                $imageRandom = "https://picsum.photos/100?random=" . $i . "&timestamp=" . time(); // timestamp permet de forcer le navigateur à charger une nouvelle image pour chaque itération
                $flore->setImg($imageRandom);
                $flore->setDescription('animal'.$i);

                $manager->persist($faune);
                $manager->persist($flore);
            }
            $manager->flush();
        }
}
