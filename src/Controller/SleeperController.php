<?php

namespace App\Controller;

use App\Entity\Slot;
use App\Entity\User;
use DateTime;
use DateInterval;
use App\Repository\SlotRepository;
use App\Repository\BedRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SleeperController extends AbstractController
{
    /**
     * @Route("/sleeper", name="sleeper")
     */
    public function index(SlotRepository $sr): Response
    {
        // Ici on récupère les rdv concernant le user connecté puis on les affiche 
        $user = $this->getUser();
        $mySlots = $sr->findBy(array("sleeper" => $user));
        $nombreDeRdv = $user->getNbRdv();
        
        return $this->render('sleeper/index.html.twig', [
            'controller_name' => 'SleeperController',
            'mySlots' => $mySlots,
            'nombreDeRdv' => $nombreDeRdv
        ]);
    }

    /**
     * @Route("/sleeper/annuler/{idRdv}", name="annuler")
     */
    public function annuler(int $idRdv, SlotRepository $sr, EntityManagerInterface $em): Response
    {
        // on trouve le rdv concerné par l'id passé en url puis on l'efface
        $slot = $sr->findById($idRdv);
        $em->remove($slot[0]);
        $em->flush();
        return $this->redirectToRoute('sleeper', [], Response::HTTP_SEE_OTHER);
        return $this->render('sleeper/annuler.html.twig', [
            'controller_name' => 'SleeperController'
        ]);
    }

    /**
     * @Route("/sleeper/slot/{idLit}/{heure}/{date}", name="slot")
     */
    public function slot(int $idLit, DateTime $heure, string $date, EntityManagerInterface $em, BedRepository $br): Response
    {
        // Cette route crée un nouveau rendez-vous au clic sur un rdv dans le tableau à l'accueil
        // Afin que le format de la date soit supporté pour la création d'un rendez-vous on change les tirets par des slashs
        // Puis on crée un nouveau rendez-vous qu'on envoie en base de données à partir des paramètres envoyés en url
        $date = str_replace("-", "/", $date);
        $ladate = new \DateTime($date);
        $bed = $br->findById($idLit);
        $slot = new Slot();
        $slot->setSleeper($this->getUser());
        $slot->setDate($ladate);
        $slot->setTime($heure);
        $slot->setTheBed($bed[0]);
        $em->persist($slot);
        $em->flush();
        
        return $this->redirectToRoute('sleeper', [], Response::HTTP_SEE_OTHER);
        return $this->render('home/slot.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

}
