<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


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
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeCategorie", inversedBy="collArmures")
     */
    private $typeCategorie;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Materiel", inversedBy="collMArmure")
     */
    private $materiel;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Equipement", inversedBy="collEArmure")
     */
    private $equipement;


    public function getDefense(): ?string
    {
        return $this->defense;
    }

    public function setDefense(int $defense): self
    {
        $this->defense = $defense;

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

    public function getEquipement(): ?Equipement
    {
        return $this->equipement;
    }

    public function setEquipement(?Equipement $equipement): self
    {
        $this->equipement = $equipement;

        return $this;
    }
}
