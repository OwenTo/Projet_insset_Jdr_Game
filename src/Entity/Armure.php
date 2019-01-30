<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArmureRepository")
 */
class Armure extends Item
{


    /**
     * @ORM\Column(type="integer")
     */
    private $defense;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Equipement", inversedBy="CollArmures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $equipement;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeCategorie", inversedBy="collArmure")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Materiel", inversedBy="collArmure")
     * @ORM\JoinColumn(nullable=false)
     */
    private $materiel;


    public function getDefense(): ?int
    {
        return $this->defense;
    }

    public function setDefense(int $defense): self
    {
        $this->defense = $defense;

        return $this;
    }

    public function getEquipement(): ?Equipement
    {
        return $this->equipement;
    }

    public function setEquipement(?Equipement $equipement): self
    {
        $this->equipement = $equipement;

        return $this;
    }

    public function getCategorie(): ?TypeCategorie
    {
        return $this->categorie;
    }

    public function setCategorie(?TypeCategorie $categorie): self
    {
        $this->categorie = $categorie;

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
