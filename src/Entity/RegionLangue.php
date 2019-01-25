<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RegionLangueRepository")
 */
class RegionLangue
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
    private $regionLangue;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Langue", mappedBy="region")
     */
    private $collRLangues;

    public function __construct()
    {
        $this->collRLangues = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegionLangue(): ?string
    {
        return $this->regionLangue;
    }

    public function setRegionLangue(string $regionLangue): self
    {
        $this->regionLangue = $regionLangue;

        return $this;
    }

    /**
     * @return Collection|Langue[]
     */
    public function getCollRLangues(): Collection
    {
        return $this->collRLangues;
    }

    public function addCollRLangue(Langue $collRLangue): self
    {
        if (!$this->collRLangues->contains($collRLangue)) {
            $this->collRLangues[] = $collRLangue;
            $collRLangue->setRegion($this);
        }

        return $this;
    }

    public function removeCollRLangue(Langue $collRLangue): self
    {
        if ($this->collRLangues->contains($collRLangue)) {
            $this->collRLangues->removeElement($collRLangue);
            // set the owning side to null (unless already changed)
            if ($collRLangue->getRegion() === $this) {
                $collRLangue->setRegion(null);
            }
        }

        return $this;
    }
}
