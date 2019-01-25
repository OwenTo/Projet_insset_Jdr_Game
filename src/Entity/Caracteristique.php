<?php

namespace App\Entity;

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
}
