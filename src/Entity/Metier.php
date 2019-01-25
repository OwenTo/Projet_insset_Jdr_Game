<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MetierRepository")
 */
class Metier
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
    private $nomMetier;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $specialisationMetier;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\NiveauMetier", mappedBy="metier")
     */
    private $niveauMetiers;

    public function __construct()
    {
        $this->niveauMetiers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomMetier(): ?string
    {
        return $this->nomMetier;
    }

    public function setNomMetier(string $nomMetier): self
    {
        $this->nomMetier = $nomMetier;

        return $this;
    }

    public function getSpecialisationMetier(): ?string
    {
        return $this->specialisationMetier;
    }

    public function setSpecialisationMetier(string $specialisationMetier): self
    {
        $this->specialisationMetier = $specialisationMetier;

        return $this;
    }

    /**
     * @return Collection|NiveauMetier[]
     */
    public function getNiveauMetiers(): Collection
    {
        return $this->niveauMetiers;
    }

    public function addNiveauMetier(NiveauMetier $niveauMetier): self
    {
        if (!$this->niveauMetiers->contains($niveauMetier)) {
            $this->niveauMetiers[] = $niveauMetier;
            $niveauMetier->setMetier($this);
        }

        return $this;
    }

    public function removeNiveauMetier(NiveauMetier $niveauMetier): self
    {
        if ($this->niveauMetiers->contains($niveauMetier)) {
            $this->niveauMetiers->removeElement($niveauMetier);
            // set the owning side to null (unless already changed)
            if ($niveauMetier->getMetier() === $this) {
                $niveauMetier->setMetier(null);
            }
        }

        return $this;
    }
}
