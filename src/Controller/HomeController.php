<?php

namespace App\Controller;

use App\Entity\TypeMatress;
use App\Entity\TypeTopperMatress;
use App\Entity\User;
use App\Entity\Bed;
use App\Entity\Size;
use App\Entity\Slot;
use DateTime;
use DateInterval;
use App\Repository\BedRepository;
use App\Repository\SlotRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(BedRepository $br): Response
    {
        //On récupère tous les lits grâce au repository
        //On initialise un tableau vide qui contiendra les horaires de rdv de chaque lit 
        //Puis on applique la méthode de montage des horaires à chaque lit

        $beds = $br->findAll();
        $heuresSemaine = [];
        foreach ($beds as $bed) {
            $heuresSemaine[] = $bed->montageSemaineHeure();
        }
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'beds' => $beds,
            'heuresSemaine' => $heuresSemaine,
            'i' => $i = 0,
            'user' => $this->getUser()
        ]);
    }
    /**
     * @Route("/help", name="help")
     */
    public function help(): Response
    {
        return $this->render('home/help.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
