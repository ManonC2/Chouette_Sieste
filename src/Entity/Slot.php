<?php

namespace App\Entity;

use App\Repository\SlotRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SlotRepository::class)
 */
class Slot
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="lesSlots")
     */
    private $sleeper;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="time")
     */
    private $time;

    /**
     * @ORM\ManyToOne(targetEntity=Bed::class, inversedBy="lesSlots")
     * @ORM\JoinColumn(nullable=false)
     */
    private $theBed;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSleeper(): ?User
    {
        return $this->sleeper;
    }

    public function setSleeper(?User $sleeper): self
    {
        $this->sleeper = $sleeper;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getTheBed(): ?Bed
    {
        return $this->theBed;
    }

    public function setTheBed(?Bed $theBed): self
    {
        $this->theBed = $theBed;

        return $this;
    }
}
