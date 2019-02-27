<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RaceRepository")
 */
class Race
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
    private $nomRace;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descriptionRace;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeRace", inversedBy="collRace")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeRace;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Compagnon", mappedBy="race")
     */
    private $collCompagnon;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\CapaciteRacial", mappedBy="collRace")
     */
    private $capaciteRacials;

    public function __construct()
    {
        $this->collCompagnon = new ArrayCollection();
        $this->capaciteRacials = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomRace(): ?string
    {
        return $this->nomRace;
    }

    public function setNomRace(string $nomRace): self
    {
        $this->nomRace = $nomRace;

        return $this;
    }

    public function getDescriptionRace(): ?string
    {
        return $this->descriptionRace;
    }

    public function setDescriptionRace(?string $descriptionRace): self
    {
        $this->descriptionRace = $descriptionRace;

        return $this;
    }

    public function getTypeRace(): ?TypeRace
    {
        return $this->typeRace;
    }

    public function setTypeRace(?TypeRace $typeRace): self
    {
        $this->typeRace = $typeRace;

        return $this;
    }

    /**
     * @return Collection|Compagnon[]
     */
    public function getCollCompagnon(): Collection
    {
        return $this->collCompagnon;
    }

    public function addCollCompagnon(Compagnon $collCompagnon): self
    {
        if (!$this->collCompagnon->contains($collCompagnon)) {
            $this->collCompagnon[] = $collCompagnon;
            $collCompagnon->setRace($this);
        }

        return $this;
    }

    public function removeCollCompagnon(Compagnon $collCompagnon): self
    {
        if ($this->collCompagnon->contains($collCompagnon)) {
            $this->collCompagnon->removeElement($collCompagnon);
            // set the owning side to null (unless already changed)
            if ($collCompagnon->getRace() === $this) {
                $collCompagnon->setRace(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CapaciteRacial[]
     */
    public function getCapaciteRacials(): Collection
    {
        return $this->capaciteRacials;
    }

    public function addCapaciteRacial(CapaciteRacial $capaciteRacial): self
    {
        if (!$this->capaciteRacials->contains($capaciteRacial)) {
            $this->capaciteRacials[] = $capaciteRacial;
            $capaciteRacial->addCollRace($this);
        }

        return $this;
    }

    public function removeCapaciteRacial(CapaciteRacial $capaciteRacial): self
    {
        if ($this->capaciteRacials->contains($capaciteRacial)) {
            $this->capaciteRacials->removeElement($capaciteRacial);
            $capaciteRacial->removeCollRace($this);
        }

        return $this;
    }
}
