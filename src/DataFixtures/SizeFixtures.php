<?php

namespace App\DataFixtures;

use App\Entity\Size;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SizeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $s1 = new Size();
        $s2 = new Size();
        $s3 = new Size();
        $s4 = new Size();
        $s5 = new Size();
        $s6 = new Size();

        $s1->setName("90x200");
        $s2->setName("120x200");
        $s3->setName("140x200");
        $s4->setName("160x200");
        $s5->setName("180x200");
        $s6->setName("200x200");
        
        $manager->persist($s1);
        $manager->persist($s2);
        $manager->persist($s3);
        $manager->persist($s4);
        $manager->persist($s5);
        $manager->persist($s6);
        $manager->flush();
    }
}
