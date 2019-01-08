<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MagieRepository")
 */
class Magie extends Item
{

    /**
     * @ORM\Column(type="integer")
     */
    private $degatMagie;

    /**
     * @ORM\Column(type="integer")
     */
    private $coutDeMana;

    /**
     * @ORM\Column(type="integer")
     */
    private $niveauMagie;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TypeMagie", mappedBy="collMagie")
     */
    private $typeMagies;

    public function __construct()
    {
        $this->typeMagies = new ArrayCollection();
    }


    public function setDegatMagie(string $degatMagie): self
    {
        $this->degatMagie = $degatMagie;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDegatMagie()
    {
        return $this->degatMagie;
    }

    public function getCoutDeMana(): ?int
    {
        return $this->coutDeMana;
    }

    public function setCoutDeMana(int $coutDeMana): self
    {
        $this->coutDeMana = $coutDeMana;

        return $this;
    }

    public function getNiveauMagie(): ?int
    {
        return $this->niveauMagie;
    }

    public function setNiveauMagie(int $niveauMagie): self
    {
        $this->niveauMagie = $niveauMagie;

        return $this;
    }

    /**
     * @return Collection|TypeMagie[]
     */
    public function getTypeMagies(): Collection
    {
        return $this->typeMagies;
    }

    public function addTypeMagy(TypeMagie $typeMagy): self
    {
        if (!$this->typeMagies->contains($typeMagy)) {
            $this->typeMagies[] = $typeMagy;
            $typeMagy->setCollMagie($this);
        }

        return $this;
    }

    public function removeTypeMagy(TypeMagie $typeMagy): self
    {
        if ($this->typeMagies->contains($typeMagy)) {
            $this->typeMagies->removeElement($typeMagy);
            // set the owning side to null (unless already changed)
            if ($typeMagy->getCollMagie() === $this) {
                $typeMagy->setCollMagie(null);
            }
        }

        return $this;
    }
}
