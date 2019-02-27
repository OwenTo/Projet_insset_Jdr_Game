<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeMagieRepository")
 */
class TypeMagie
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
    private $nomTypeMagie;



    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\InventaireMagie", mappedBy="typeMagieInventaire")
     */
    private $inventaireMagies;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Magie", mappedBy="typeMagie")
     */
    private $magies;

    public function __construct()
    {
        $this->inventaireMagies = new ArrayCollection();
        $this->magies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomTypeMagie(): ?string
    {
        return $this->nomTypeMagie;
    }

    public function setNomTypeMagie(string $nomTypeMagie): self
    {
        $this->nomTypeMagie = $nomTypeMagie;

        return $this;
    }



    /**
     * @return Collection|InventaireMagie[]
     */
    public function getInventaireMagies(): Collection
    {
        return $this->inventaireMagies;
    }

    public function addInventaireMagy(InventaireMagie $inventaireMagy): self
    {
        if (!$this->inventaireMagies->contains($inventaireMagy)) {
            $this->inventaireMagies[] = $inventaireMagy;
            $inventaireMagy->addTypeMagieInventaire($this);
        }

        return $this;
    }

    public function removeInventaireMagy(InventaireMagie $inventaireMagy): self
    {
        if ($this->inventaireMagies->contains($inventaireMagy)) {
            $this->inventaireMagies->removeElement($inventaireMagy);
            $inventaireMagy->removeTypeMagieInventaire($this);
        }

        return $this;
    }

    /**
     * @return Collection|Magie[]
     */
    public function getMagies(): Collection
    {
        return $this->magies;
    }

    public function addMagy(Magie $magy): self
    {
        if (!$this->magies->contains($magy)) {
            $this->magies[] = $magy;
            $magy->addTypeMagie($this);
        }

        return $this;
    }

    public function removeMagy(Magie $magy): self
    {
        if ($this->magies->contains($magy)) {
            $this->magies->removeElement($magy);
            $magy->removeTypeMagie($this);
        }

        return $this;
    }
}
