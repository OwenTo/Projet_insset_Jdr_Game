<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InventaireArmeRepository")

 */
class InventaireArme extends InventaireItem
{


    /**
     * @ORM\Column(type="integer")
     */
    private $degatArmeInventaire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeArme", inversedBy="inventaireArmes")
     */
    private $typeArmeInventaire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeCategorie", inversedBy="inventaireArmes")
     */
    private $typeCategorieInventaire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Materiel", inversedBy="inventaireArmes")
     */
    private $materielInventaire;



    public function getDegatArmeInventaire(): ?int
    {
        return $this->degatArmeInventaire;
    }

    public function setDegatArmeInventaire(int $degatArmeInventaire): self
    {
        $this->degatArmeInventaire = $degatArmeInventaire;

        return $this;
    }

    public function getTypeArmeInventaire(): ?TypeArme
    {
        return $this->typeArmeInventaire;
    }

    public function setTypeArmeInventaire(?TypeArme $typeArmeInventaire): self
    {
        $this->typeArmeInventaire = $typeArmeInventaire;

        return $this;
    }

    public function getTypeCategorieInventaire(): ?TypeCategorie
    {
        return $this->typeCategorieInventaire;
    }

    public function setTypeCategorieInventaire(?TypeCategorie $typeCategorieInventaire): self
    {
        $this->typeCategorieInventaire = $typeCategorieInventaire;

        return $this;
    }

    public function getMaterielInventaire(): ?Materiel
    {
        return $this->materielInventaire;
    }

    public function setMaterielInventaire(?Materiel $materielInventaire): self
    {
        $this->materielInventaire = $materielInventaire;

        return $this;
    }
}
