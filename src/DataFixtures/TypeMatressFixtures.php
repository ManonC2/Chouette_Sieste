<?php

namespace App\DataFixtures;

use App\Entity\TypeMatress;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypeMatressFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $m1 = new TypeMatress();
        $m1->setName("Mousse polyéther");
        $m2 = new TypeMatress();
        $m2->setName("Mousse polyuréthane");
        $m3 = new TypeMatress();
        $m3->setName("Mousse à mémoire de forme");
        $m4 = new TypeMatress();
        $m4->setName("Ressorts biconiques");
        $m5 = new TypeMatress();
        $m5->setName("Ressorts ensachés");
        $m6 = new TypeMatress();
        $m6->setName("Latex naturel");
        $m7 = new TypeMatress();
        $m7->setName("Latex synthétique");
        $m8 = new TypeMatress();
        $m8->setName("Matelas à eau");
        $m9 = new TypeMatress();
        $m9->setName("Matelas hybride");


        $manager->persist($m1);
        $manager->persist($m2);
        $manager->persist($m3);
        $manager->persist($m4);
        $manager->persist($m5);
        $manager->persist($m6);
        $manager->persist($m7);
        $manager->persist($m8);
        $manager->persist($m9);

        $manager->flush();
    }
}
