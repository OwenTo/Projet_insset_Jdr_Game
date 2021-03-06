<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\MonnaieRepository")
 */
class Monnaie
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
    private $nomMonnaie;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Item", mappedBy="monnaie")
     */
    private $collItems;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\InventaireItem", mappedBy="monnaie")
     */
    private $inventaireItems;

    public function __construct()
    {
        $this->collItems = new ArrayCollection();
        $this->inventaireItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomMonnaie(): ?string
    {
        return $this->nomMonnaie;
    }

    public function setNomMonnaie(string $nomMonnaie): self
    {
        $this->nomMonnaie = $nomMonnaie;

        return $this;
    }

    /**
     * @return Collection|Item[]
     */
    public function getCollItems(): Collection
    {
        return $this->collItems;
    }

    public function addCollItem(Item $collItem): self
    {
        if (!$this->collItems->contains($collItem)) {
            $this->collItems[] = $collItem;
            $collItem->setMonnaie($this);
        }

        return $this;
    }

    public function removeCollItem(Item $collItem): self
    {
        if ($this->collItems->contains($collItem)) {
            $this->collItems->removeElement($collItem);
            // set the owning side to null (unless already changed)
            if ($collItem->getMonnaie() === $this) {
                $collItem->setMonnaie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|InventaireItem[]
     */
    public function getInventaireItems(): Collection
    {
        return $this->inventaireItems;
    }

    public function addInventaireItem(InventaireItem $inventaireItem): self
    {
        if (!$this->inventaireItems->contains($inventaireItem)) {
            $this->inventaireItems[] = $inventaireItem;
            $inventaireItem->setMonnaie($this);
        }

        return $this;
    }

    public function removeInventaireItem(InventaireItem $inventaireItem): self
    {
        if ($this->inventaireItems->contains($inventaireItem)) {
            $this->inventaireItems->removeElement($inventaireItem);
            // set the owning side to null (unless already changed)
            if ($inventaireItem->getMonnaie() === $this) {
                $inventaireItem->setMonnaie(null);
            }
        }

        return $this;
    }
}
