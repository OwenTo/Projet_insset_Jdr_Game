<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\InheritanceType;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CaracteristiqueRepository")
 *
 * @InheritanceType("JOINED")
 * @DiscriminatorColumn(name="enfant", type="string")
 * @DiscriminatorMap({"caracteristique" = "Caracteristique", "caracteristiquePrincipal" = "CaracteristiquePrincipal","CaracteristiqueSecondaire"="CaracteristiqueSecondaire"})
 */
class Caracteristique
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
    private $nomCaracteristique;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ValeurCaract", mappedBy="caracteristique")
     */
    private $valeurCaracts;

    public function __construct()
    {
        $this->valeurCaracts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCaracteristique(): ?string
    {
        return $this->nomCaracteristique;
    }

    public function setNomCaracteristique(string $nomCaracteristique): self
    {
        $this->nomCaracteristique = $nomCaracteristique;

        return $this;
    }

    /**
     * @return Collection|ValeurCaract[]
     */
    public function getValeurCaracts(): Collection
    {
        return $this->valeurCaracts;
    }

    public function addValeurCaract(ValeurCaract $valeurCaract): self
    {
        if (!$this->valeurCaracts->contains($valeurCaract)) {
            $this->valeurCaracts[] = $valeurCaract;
            $valeurCaract->setCaracteristique($this);
        }

        return $this;
    }

    public function removeValeurCaract(ValeurCaract $valeurCaract): self
    {
        if ($this->valeurCaracts->contains($valeurCaract)) {
            $this->valeurCaracts->removeElement($valeurCaract);
            // set the owning side to null (unless already changed)
            if ($valeurCaract->getCaracteristique() === $this) {
                $valeurCaract->setCaracteristique(null);
            }
        }

        return $this;
    }
}
