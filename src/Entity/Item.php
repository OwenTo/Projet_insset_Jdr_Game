<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ItemRepository")
 */
class Item
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
    private $nomItem;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionItem;

    /**
     * @ORM\Column(type="float")
     */
    private $poids;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $beneficeMaluce;

    /**
     * @ORM\Column(type="integer")
     */
    private $valeur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomItem(): ?string
    {
        return $this->nomItem;
    }

    public function setNomItem(string $nomItem): self
    {
        $this->nomItem = $nomItem;

        return $this;
    }

    public function getDescriptionItem(): ?string
    {
        return $this->descriptionItem;
    }

    public function setDescriptionItem(?string $descriptionItem): self
    {
        $this->descriptionItem = $descriptionItem;

        return $this;
    }

    public function getPoids(): ?float
    {
        return $this->poids;
    }

    public function setPoids(float $poids): self
    {
        $this->poids = $poids;

        return $this;
    }

    public function getBeneficeMaluce(): ?string
    {
        return $this->beneficeMaluce;
    }

    public function setBeneficeMaluce(?string $beneficeMaluce): self
    {
        $this->beneficeMaluce = $beneficeMaluce;

        return $this;
    }

    public function getValeur(): ?int
    {
        return $this->valeur;
    }

    public function setValeur(int $valeur): self
    {
        $this->valeur = $valeur;

        return $this;
    }
}
