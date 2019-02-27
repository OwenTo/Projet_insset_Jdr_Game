<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompagnonTypeRepository")
 */
class CompagnonType
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
    private $typeCompagnon;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Compagnon", mappedBy="compagnonType")
     */
    private $collTCompagnons;

    public function __construct()
    {
        $this->collTCompagnons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeCompagnon(): ?string
    {
        return $this->typeCompagnon;
    }

    public function setTypeCompagnon(string $typeCompagnon): self
    {
        $this->typeCompagnon = $typeCompagnon;

        return $this;
    }

    /**
     * @return Collection|Compagnon[]
     */
    public function getCollTCompagnons(): Collection
    {
        return $this->collTCompagnons;
    }

    public function addCollTCompagnon(Compagnon $collTCompagnon): self
    {
        if (!$this->collTCompagnons->contains($collTCompagnon)) {
            $this->collTCompagnons[] = $collTCompagnon;
            $collTCompagnon->setCompagnonType($this);
        }

        return $this;
    }

    public function removeCollTCompagnon(Compagnon $collTCompagnon): self
    {
        if ($this->collTCompagnons->contains($collTCompagnon)) {
            $this->collTCompagnons->removeElement($collTCompagnon);
            // set the owning side to null (unless already changed)
            if ($collTCompagnon->getCompagnonType() === $this) {
                $collTCompagnon->setCompagnonType(null);
            }
        }

        return $this;
    }
}
