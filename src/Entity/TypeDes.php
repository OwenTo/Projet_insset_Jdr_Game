<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeDesRepository")
 */
class TypeDes
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
    private $des;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Item", mappedBy="typeDes")
     */
    private $collItems;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\InventaireItem", mappedBy="typesDes")
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

    public function getDes(): ?string
    {
        return $this->des;
    }

    public function setDes(string $des): self
    {
        $this->des = $des;

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
            $collItem->setTypeDes($this);
        }

        return $this;
    }

    public function removeCollItem(Item $collItem): self
    {
        if ($this->collItems->contains($collItem)) {
            $this->collItems->removeElement($collItem);
            // set the owning side to null (unless already changed)
            if ($collItem->getTypeDes() === $this) {
                $collItem->setTypeDes(null);
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
            $inventaireItem->setTypesDes($this);
        }

        return $this;
    }

    public function removeInventaireItem(InventaireItem $inventaireItem): self
    {
        if ($this->inventaireItems->contains($inventaireItem)) {
            $this->inventaireItems->removeElement($inventaireItem);
            // set the owning side to null (unless already changed)
            if ($inventaireItem->getTypesDes() === $this) {
                $inventaireItem->setTypesDes(null);
            }
        }

        return $this;
    }
}
