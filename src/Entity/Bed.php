<?php

namespace App\Entity;
use App\Repository\SlotRepository;
use App\Repository\BedRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DateTime;
use DatePeriod;
use DateInterval;
use Doctrine\ORM\EntityManagerInterface;


/**
 * @ORM\Entity(repositoryClass=BedRepository::class)
 */
class Bed
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\ManyToOne(targetEntity=TypeMatress::class, inversedBy="beds")
     */
    private $leTypeMatress;

    /**
     * @ORM\ManyToOne(targetEntity=TypeTopperMatress::class, inversedBy="beds")
     */
    private $leTypeTopperMatress;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="lesBeds")
     */
    private $renter;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Slot::class, mappedBy="theBed")
     */
    private $lesSlots;

    /**
     * @ORM\ManyToOne(targetEntity=Size::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $size;

    public function __construct()
    {
        $this->lesSlots = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLeTypeMatress(): ?TypeMatress
    {
        return $this->leTypeMatress;
    }

    public function setLeTypeMatress(?TypeMatress $leTypeMatress): self
    {
        $this->leTypeMatress = $leTypeMatress;

        return $this;
    }

    public function getLeTypeTopperMatress(): ?TypeTopperMatress
    {
        return $this->leTypeTopperMatress;
    }

    public function setLeTypeTopperMatress(?TypeTopperMatress $leTypeTopperMatress): self
    {
        $this->leTypeTopperMatress = $leTypeTopperMatress;

        return $this;
    }

    public function getRenter(): ?User
    {
        return $this->renter;
    }

    public function setRenter(?User $renter): self
    {
        $this->renter = $renter;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
        /**
     * @return Collection|Slot[]
     */
    public function getLesSlots(): Collection
    {
        return $this->lesSlots;
    }

    public function addLesSlot(Slot $lesSlot): self
    {
        if (!$this->lesSlots->contains($lesSlot)) {
            $this->lesSlots[] = $lesSlot;
            $lesSlot->setTheBed($this);
        }

        return $this;
    }

    public function removeLesSlot(Slot $lesSlot): self
    {
        if ($this->lesSlots->removeElement($lesSlot)) {
            // set the owning side to null (unless already changed)
            if ($lesSlot->getTheBed() === $this) {
                $lesSlot->setTheBed(null);
            }
        }

        return $this;
    }

    public function getSize(): ?Size
    {
        return $this->size;
    }

    public function setSize(?Size $size): self
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Cette méthode retourne un tableau à plusieurs dimensions contenant les horaires de chaque lit pour chaque jour dans une semaine.
     * Si un rdv concerne un lit pour une certaine date et une certaine heure celles-ci seront remplacées par un tiret dans le tableau.
     */
    public function montageSemaineHeure(): array
    {
        $semaine = [];
        $slots = [];
        $aujourdhui = new DateTime();
        $jour = $aujourdhui->format('l m-d');
        // On récupère le loueur concernant le lit puis on formate ses horaires de début et de fin de journée en H:i
        $renter = $this->getRenter();
        $start = strtotime($renter->getDebut()->format('H:i'));
        $end = strtotime($renter->getFin()->format('H:i'));
        $slots = $this->getLesSlots();
        $journee = [];
        //Cette boucle for permet de parcourir toutes les heures de la journée du loueur 
        for ($i = 0; $i <= ($end - $start) / 3600; $i++) {
            if ($slots[0] != null) {
                //Cette boucle vérifie l'existence d'un rendez-vous concernant une heure.
                //Si un rdv existe, le tableau sera incrémenté d'un "-", auquel cas il sera implémenté de l'heure concernée
                foreach ($slots as $slot) {
                    $time = date('H:i', $start + $i * 3600);
                    $timeslot = $slot->getTime()->format('H:i');
                    $dateSlot = $slot->getDate()->format('l m-d');
                    if ($timeslot == $time && $dateSlot == $jour) {
                        $journee[$i] = '-';
                        break;
                    } else {
                        $journee[$i] = $time;
                    }
                }
            } else {
                $time = date('H:i', $start + $i * 3600);
                $journee[$i] = $time;
            }
        }
        // On ajoute le premier jour rempli de ses horaires au tableau de la semaine
        $semaine[$jour] = $journee;
        // Même mécanique qu'au dessus, pour la semaine suivant le jour présent 
        for ($i = 1; $i < 8; $i++) {
            $jour = [];
            $jourSuivant = $aujourdhui->add(new DateInterval('P1D'))->format('l m-d');
            for ($a = 0; $a <= ($end - $start) / 3600; $a++) {
                if ($slots[0] != null) {
                    foreach ($slots as $slot) {
                        $time = date('H:i', $start + $a * 3600);
                        $timeslot = $slot->getTime()->format('H:i');
                        $dateSlot = $slot->getDate()->format('l m-d');
                        if ($timeslot == $time && $dateSlot == $jourSuivant) {
                            $jour[$a] = '-';
                            break;
                        } else {
                            $jour[$a] = $time;
                        }
                    }
                } else {
                    $time = date('H:i', $start + $a * 3600);
                    $jour[$a] = $time;
                }
            }
            $semaine[$jourSuivant] = $jour;
        }
        return $semaine;
    }
    // Cette méthode supprime un lit et les rdv associés à celui-ci
    public function supprimerLit(SlotREpository $sr, EntityManagerInterface $em){
        $slot = $sr->findBy(array("theBed" => $this));
        foreach($slot as $s) {
        $em->remove($s);
        $em->flush();
        }
        $em->remove($this);
        $em->flush();
    }
}
