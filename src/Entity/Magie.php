<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\ManyToMany(targetEntity="App\Entity\TypeMagie", inversedBy="magies")
     */
    private $typeMagie;



    public function __construct()
    {
        $this->typeMagies = new ArrayCollection();
        $this->typeMagie = new ArrayCollection();
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
    public function getTypeMagie(): Collection
    {
        return $this->typeMagie;
    }

    public function addTypeMagie(TypeMagie $typeMagie): self
    {
        if (!$this->typeMagie->contains($typeMagie)) {
            $this->typeMagie[] = $typeMagie;
        }

        return $this;
    }

    public function removeTypeMagie(TypeMagie $typeMagie): self
    {
        if ($this->typeMagie->contains($typeMagie)) {
            $this->typeMagie->removeElement($typeMagie);
        }

        return $this;
    }


}
