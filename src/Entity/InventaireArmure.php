<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InventaireArmureRepository")
 */
class InventaireArmure extends InventaireItem
{


    /**
     * @ORM\Column(type="integer")
     */
    private $defenseArmureInventaire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Equipement", inversedBy="inventaireArmures")
     */
    private $equipementInventaire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeCategorie", inversedBy="inventaireArmures")
     */
    private $categorieArmureInventaire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Materiel", inversedBy="inventaireArmures")
     */
    private $materielArmureInventaire;


    public function getDefenseArmureInventaire(): ?int
    {
        return $this->defenseArmureInventaire;
    }

    public function setDefenseArmureInventaire(int $defenseArmureInventaire): self
    {
        $this->defenseArmureInventaire = $defenseArmureInventaire;

        return $this;
    }

    public function getEquipementInventaire(): ?Equipement
    {
        return $this->equipementInventaire;
    }

    public function setEquipementInventaire(?Equipement $equipementInventaire): self
    {
        $this->equipementInventaire = $equipementInventaire;

        return $this;
    }

    public function getCategorieArmureInventaire(): ?TypeCategorie
    {
        return $this->categorieArmureInventaire;
    }

    public function setCategorieArmureInventaire(?TypeCategorie $categorieArmureInventaire): self
    {
        $this->categorieArmureInventaire = $categorieArmureInventaire;

        return $this;
    }

    public function getMaterielArmureInventaire(): ?Materiel
    {
        return $this->materielArmureInventaire;
    }

    public function setMaterielArmureInventaire(?Materiel $materielArmureInventaire): self
    {
        $this->materielArmureInventaire = $materielArmureInventaire;

        return $this;
    }
}
