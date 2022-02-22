<?php
namespace App\Tests\Entity;

use App\Entity\User;
use App\Entity\Slot;
use App\Repository\UserRepository;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function test()
    {
        //Initialisation du jeu d'essai
        $user = new User();
        $s1 = new Slot();
        $s2 = new Slot();

        $user->addLesSlot($s1);
        $user->addLesSlot($s2);

        // Passage du résultat à tester dans une variable resultat
        $resultat = $user->getNbRdv();

        //Test d'assertion
        $this->assertEquals(2, $resultat);
    }
}