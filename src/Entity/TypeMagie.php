<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeMagieRepository")
 */
class TypeMagie
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
    private $nomTypeMagie;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Magie", inversedBy="typeMagies")
     */
    private $collMagie;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\InventaireMagie", mappedBy="typeMagieInventaire")
     */
    private $inventaireMagies;

    public function __construct()
    {
        $this->inventaireMagies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomTypeMagie(): ?string
    {
        return $this->nomTypeMagie;
    }

    public function setNomTypeMagie(string $nomTypeMagie): self
    {
        $this->nomTypeMagie = $nomTypeMagie;

        return $this;
    }

    public function getCollMagie(): ?Magie
    {
        return $this->collMagie;
    }

    public function setCollMagie(?Magie $collMagie): self
    {
        $this->collMagie = $collMagie;

        return $this;
    }

    /**
     * @return Collection|InventaireMagie[]
     */
    public function getInventaireMagies(): Collection
    {
        return $this->inventaireMagies;
    }

    public function addInventaireMagy(InventaireMagie $inventaireMagy): self
    {
        if (!$this->inventaireMagies->contains($inventaireMagy)) {
            $this->inventaireMagies[] = $inventaireMagy;
            $inventaireMagy->addTypeMagieInventaire($this);
        }

        return $this;
    }

    public function removeInventaireMagy(InventaireMagie $inventaireMagy): self
    {
        if ($this->inventaireMagies->contains($inventaireMagy)) {
            $this->inventaireMagies->removeElement($inventaireMagy);
            $inventaireMagy->removeTypeMagieInventaire($this);
        }

        return $this;
    }
}
