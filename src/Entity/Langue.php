<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LangueRepository")
 */
class Langue
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
    private $nomLangue;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\RegionLangue", inversedBy="collRLangues")
     */
    private $region;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\LangueType", mappedBy="collLangues")
     */
    private $langueTypes;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Personnage", mappedBy="collLangues")
     */
    private $personnages;

    public function __construct()
    {
        $this->langueTypes = new ArrayCollection();
        $this->personnages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomLangue(): ?string
    {
        return $this->nomLangue;
    }

    public function setNomLangue(string $nomLangue): self
    {
        $this->nomLangue = $nomLangue;

        return $this;
    }

    public function getRegion(): ?RegionLangue
    {
        return $this->region;
    }

    public function setRegion(?RegionLangue $region): self
    {
        $this->region = $region;

        return $this;
    }

    /**
     * @return Collection|LangueType[]
     */
    public function getLangueTypes(): Collection
    {
        return $this->langueTypes;
    }

    public function addLangueType(LangueType $langueType): self
    {
        if (!$this->langueTypes->contains($langueType)) {
            $this->langueTypes[] = $langueType;
            $langueType->addCollLangue($this);
        }

        return $this;
    }

    public function removeLangueType(LangueType $langueType): self
    {
        if ($this->langueTypes->contains($langueType)) {
            $this->langueTypes->removeElement($langueType);
            $langueType->removeCollLangue($this);
        }

        return $this;
    }

    /**
     * @return Collection|Personnage[]
     */
    public function getPersonnages(): Collection
    {
        return $this->personnages;
    }

    public function addPersonnage(Personnage $personnage): self
    {
        if (!$this->personnages->contains($personnage)) {
            $this->personnages[] = $personnage;
            $personnage->addCollLangue($this);
        }

        return $this;
    }

    public function removePersonnage(Personnage $personnage): self
    {
        if ($this->personnages->contains($personnage)) {
            $this->personnages->removeElement($personnage);
            $personnage->removeCollLangue($this);
        }

        return $this;
    }
}
