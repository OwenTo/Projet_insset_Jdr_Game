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

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Race", inversedBy="collCompagnon")
     * @ORM\JoinColumn(nullable=false)
     */
    private $race;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Personnage", inversedBy="collCompagnons")
     */
    private $personnage;

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

    public function getRace(): ?Race
    {
        return $this->race;
    }

    public function setRace(?Race $race): self
    {
        $this->race = $race;

        return $this;
    }

    public function getPersonnage(): ?Personnage
    {
        return $this->personnage;
    }

    public function setPersonnage(?Personnage $personnage): self
    {
        $this->personnage = $personnage;

        return $this;
    }
}
