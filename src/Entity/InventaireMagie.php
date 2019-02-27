<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InventaireMagieRepository")
 */
class InventaireMagie extends InventaireItem
{


    /**
     * @ORM\Column(type="integer")
     */
    private $degatMagieInventaire;

    /**
     * @ORM\Column(type="integer")
     */
    private $coutManaMagieInventaire;

    /**
     * @ORM\Column(type="integer")
     */
    private $niveauMagieInventaire;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\TypeMagie", inversedBy="inventaireMagies")
     */
    private $typeMagieInventaire;

    public function __construct()
    {
        $this->typeMagieInventaire = new ArrayCollection();
    }



    public function getDegatMagieInventaire(): ?int
    {
        return $this->degatMagieInventaire;
    }

    public function setDegatMagieInventaire(int $degatMagieInventaire): self
    {
        $this->degatMagieInventaire = $degatMagieInventaire;

        return $this;
    }

    public function getCoutManaMagieInventaire(): ?int
    {
        return $this->coutManaMagieInventaire;
    }

    public function setCoutManaMagieInventaire(int $coutManaMagieInventaire): self
    {
        $this->coutManaMagieInventaire = $coutManaMagieInventaire;

        return $this;
    }

    public function getNiveauMagieInventaire(): ?int
    {
        return $this->niveauMagieInventaire;
    }

    public function setNiveauMagieInventaire(int $niveauMagieInventaire): self
    {
        $this->niveauMagieInventaire = $niveauMagieInventaire;

        return $this;
    }

    /**
     * @return Collection|TypeMagie[]
     */
    public function getTypeMagieInventaire(): Collection
    {
        return $this->typeMagieInventaire;
    }

    public function addTypeMagieInventaire(TypeMagie $typeMagieInventaire): self
    {
        if (!$this->typeMagieInventaire->contains($typeMagieInventaire)) {
            $this->typeMagieInventaire[] = $typeMagieInventaire;
        }

        return $this;
    }

    public function removeTypeMagieInventaire(TypeMagie $typeMagieInventaire): self
    {
        if ($this->typeMagieInventaire->contains($typeMagieInventaire)) {
            $this->typeMagieInventaire->removeElement($typeMagieInventaire);
        }

        return $this;
    }
}
