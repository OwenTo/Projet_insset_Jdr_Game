<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeRaceRepository")
 */
class TypeRace
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
    private $typeRace;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Race", mappedBy="typeRace")
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

    public function getTypeRace(): ?string
    {
        return $this->typeRace;
    }

    public function setTypeRace(string $typeRace): self
    {
        $this->typeRace = $typeRace;

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
            $collRace->setTypeRace($this);
        }

        return $this;
    }

    public function removeCollRace(Race $collRace): self
    {
        if ($this->collRace->contains($collRace)) {
            $this->collRace->removeElement($collRace);
            // set the owning side to null (unless already changed)
            if ($collRace->getTypeRace() === $this) {
                $collRace->setTypeRace(null);
            }
        }

        return $this;
    }
}
