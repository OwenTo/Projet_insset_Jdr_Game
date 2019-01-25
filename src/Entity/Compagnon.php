<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompagnonRepository")
 */
class Compagnon
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
    private $Sexe;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $prixAchatVente;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CompagnonType", inversedBy="collTCompagnons")
     * @ORM\JoinColumn(nullable=false)
     */
    private $compagnonType;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSexe(): ?string
    {
        return $this->Sexe;
    }

    public function setSexe(string $Sexe): self
    {
        $this->Sexe = $Sexe;

        return $this;
    }

    public function getPrixAchatVente(): ?int
    {
        return $this->prixAchatVente;
    }

    public function setPrixAchatVente(?int $prixAchatVente): self
    {
        $this->prixAchatVente = $prixAchatVente;

        return $this;
    }

    public function getCompagnonType(): ?CompagnonType
    {
        return $this->compagnonType;
    }

    public function setCompagnonType(?CompagnonType $compagnonType): self
    {
        $this->compagnonType = $compagnonType;

        return $this;
    }
}
