<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeArmeRepository")
 */
class TypeArme
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
    private $nomTypeArme;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Arme", mappedBy="typeArme")
     */
    private $collArmes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\InventaireArme", mappedBy="typeArmeInventaire")
     */
    private $inventaireArmes;

    public function __construct()
    {
        $this->collArmes = new ArrayCollection();
        $this->inventaireArmes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomTypeArme(): ?string
    {
        return $this->nomTypeArme;
    }

    public function setNomTypeArme(string $nomTypeArme): self
    {
        $this->nomTypeArme = $nomTypeArme;

        return $this;
    }

    /**
     * @return Collection|Arme[]
     */
    public function getCollArmes(): Collection
    {
        return $this->collArmes;
    }

    public function addCollArme(Arme $collArme): self
    {
        if (!$this->collArmes->contains($collArme)) {
            $this->collArmes[] = $collArme;
            $collArme->setTypeArme($this);
        }

        return $this;
    }

    public function removeCollArme(Arme $collArme): self
    {
        if ($this->collArmes->contains($collArme)) {
            $this->collArmes->removeElement($collArme);
            // set the owning side to null (unless already changed)
            if ($collArme->getTypeArme() === $this) {
                $collArme->setTypeArme(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|InventaireArme[]
     */
    public function getInventaireArmes(): Collection
    {
        return $this->inventaireArmes;
    }

    public function addInventaireArme(InventaireArme $inventaireArme): self
    {
        if (!$this->inventaireArmes->contains($inventaireArme)) {
            $this->inventaireArmes[] = $inventaireArme;
            $inventaireArme->setTypeArmeInventaire($this);
        }

        return $this;
    }

    public function removeInventaireArme(InventaireArme $inventaireArme): self
    {
        if ($this->inventaireArmes->contains($inventaireArme)) {
            $this->inventaireArmes->removeElement($inventaireArme);
            // set the owning side to null (unless already changed)
            if ($inventaireArme->getTypeArmeInventaire() === $this) {
                $inventaireArme->setTypeArmeInventaire(null);
            }
        }

        return $this;
    }
}
