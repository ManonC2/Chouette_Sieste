<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Bed;
use App\Form\BedType;
use App\Repository\BedRepository;
use App\Repository\SlotRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/renter")
 */

class RenterController extends AbstractController
{
    /**
     * @Route("/", name="renter")
     */
    public function index(): Response
    {
        return $this->render('renter/index.html.twig', [
            'controller_name' => 'RenterController',
        ]);
    }
    /**
     * @Route("/my_beds", name="my_beds")
     */
    public function myBeds(BedRepository $br): Response
    {
        $user = $this->getUser();
        $beds = $br->findBy(array("renter" => $user));
        return $this->render('renter/my_beds.html.twig', [
            'controller_name' => 'RenterController',
            'user' => $user,
            'beds' => $beds
        ]);
    }
    /**
     * @Route("/new_bed", name="new_bed")
     */
    public function newBed(Request $request, EntityManagerInterface $em): Response
    {
        $bed = new Bed();
        $bed->setRenter($this->getUser());
        $formBed = $this->createForm(BedType::class, $bed);

        $formBed->handleRequest($request);

        if ($formBed->isSubmitted() && $formBed->isValid()) {
            $em->persist($bed);
            $em->flush();
            return $this->redirectToRoute('renter', [], Response::HTTP_SEE_OTHER);

        }

        return $this->render('renter/new_bed.html.twig', [
            'controller_name' => 'NewBedController', 'form' => $formBed->createView()
        ]);
    }
    /**
     * @Route("/supprimer/lit/{idLit}", name="supprimerLit")
     */
    public function supprimerLit(int $idLit, SlotRepository $sr, BedRepository $br, EntityManagerInterface $em): Response
    {
        $bed = $br->findById($idLit);
        $bed[0]->supprimerLit($sr, $em);
        return $this->redirectToRoute('my_beds', [], Response::HTTP_SEE_OTHER);
        return $this->render('renter/annuler.html.twig', [
            'controller_name' => 'RenterController'
        ]);
    }

    /**
     * @Route("/confirmation/lit/{idLit}", name="confirmerSuppressionLit")
     */
    public function confirmationSupprimerLit(int $idLit, BedRepository $br, EntityManagerInterface $em): Response
    {
        $bed = $br->findById($idLit);

        return $this->render('renter/supprimer_lit.html.twig', [
            'bed' => $bed[0],
            'controller_name' => 'RenterController'
        ]);
    }
}
