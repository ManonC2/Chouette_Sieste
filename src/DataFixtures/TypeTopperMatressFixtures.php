<?php

namespace App\DataFixtures;

use App\Entity\TypeTopperMatress;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypeTopperMatressFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $tm1 = new TypeTopperMatress();
        $tm1->setName("En plumes");
        $tm2 = new TypeTopperMatress();
        $tm2->setName("En latex");
        $tm3 = new TypeTopperMatress();
        $tm3->setName("A mémoire de forme");
        $tm4 = new TypeTopperMatress();
        $tm4->setName("Pas de surmatelas");

        $manager->persist($tm1);
        $manager->persist($tm2);
        $manager->persist($tm3);
        $manager->persist($tm4);

        $manager->flush();
    }
}
