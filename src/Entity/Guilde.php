<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GuildeRepository")
 */
class Guilde
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
    private $nomGuilde;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $MaitreGuilde;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeGuilde", inversedBy="collTGuilde")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeGuilde;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RangGuilde", mappedBy="guilde")
     */
    private $rangGuildes;

    public function __construct()
    {
        $this->rangGuildes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomGuilde(): ?string
    {
        return $this->nomGuilde;
    }

    public function setNomGuilde(string $nomGuilde): self
    {
        $this->nomGuilde = $nomGuilde;

        return $this;
    }

    public function getMaitreGuilde(): ?string
    {
        return $this->MaitreGuilde;
    }

    public function setMaitreGuilde(string $MaitreGuilde): self
    {
        $this->MaitreGuilde = $MaitreGuilde;

        return $this;
    }

    public function getTypeGuilde(): ?TypeGuilde
    {
        return $this->typeGuilde;
    }

    public function setTypeGuilde(?TypeGuilde $typeGuilde): self
    {
        $this->typeGuilde = $typeGuilde;

        return $this;
    }

    /**
     * @return Collection|RangGuilde[]
     */
    public function getRangGuildes(): Collection
    {
        return $this->rangGuildes;
    }

    public function addRangGuilde(RangGuilde $rangGuilde): self
    {
        if (!$this->rangGuildes->contains($rangGuilde)) {
            $this->rangGuildes[] = $rangGuilde;
            $rangGuilde->setGuilde($this);
        }

        return $this;
    }

    public function removeRangGuilde(RangGuilde $rangGuilde): self
    {
        if ($this->rangGuildes->contains($rangGuilde)) {
            $this->rangGuildes->removeElement($rangGuilde);
            // set the owning side to null (unless already changed)
            if ($rangGuilde->getGuilde() === $this) {
                $rangGuilde->setGuilde(null);
            }
        }

        return $this;
    }
}
