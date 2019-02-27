<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CapaciteRacialRepository")
 */
class CapaciteRacial
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $capacite;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Race", inversedBy="capaciteRacials")
     */
    private $collRace;

    public function __construct()
    {
        $this->collRace = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCapacite(): ?string
    {
        return $this->capacite;
    }

    public function setCapacite(string $capacite): self
    {
        $this->capacite = $capacite;

        return $this;
    }

    /**
     * @return Collection|Race[]
     */
    public function getCollRace(): Collection
    {
        return $this->collRace;
    }

    public function addCollRace(Race $collRace): self
    {
        if (!$this->collRace->contains($collRace)) {
            $this->collRace[] = $collRace;
        }

        return $this;
    }

    public function removeCollRace(Race $collRace): self
    {
        if ($this->collRace->contains($collRace)) {
            $this->collRace->removeElement($collRace);
        }

        return $this;
    }
}
