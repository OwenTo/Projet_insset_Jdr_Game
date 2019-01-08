<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArmeRepository")
 */
class Arme extends Item
{


    /**
     * @ORM\Column(type="integer")
     */
    private $degat;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeArme", inversedBy="collArmes")
     */
    private $typeArme;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeCategorie", inversedBy="collArmes")
     */
    private $typeCategorie;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Materiel", inversedBy="collMArmes")
     */
    private $materiel;



    public function setDegat(int $degat): self
    {
        $this->degat = $degat;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDegat()
    {
        return $this->degat;
    }

    public function getTypeArme(): ?TypeArme
    {
        return $this->typeArme;
    }

    public function setTypeArme(?TypeArme $typeArme): self
    {
        $this->typeArme = $typeArme;

        return $this;
    }

    public function getTypeCategorie(): ?TypeCategorie
    {
        return $this->typeCategorie;
    }

    public function setTypeCategorie(?TypeCategorie $typeCategorie): self
    {
        $this->typeCategorie = $typeCategorie;

        return $this;
    }

    public function getMateriel(): ?Materiel
    {
        return $this->materiel;
    }

    public function setMateriel(?Materiel $materiel): self
    {
        $this->materiel = $materiel;

        return $this;
    }
}
