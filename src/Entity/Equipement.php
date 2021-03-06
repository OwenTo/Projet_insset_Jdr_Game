<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\EquipementRepository")
 */
class Equipement
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
    private $nomEquipement;



    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Armure", mappedBy="equipement")
     */
    private $CollArmures;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\InventaireArmure", mappedBy="equipementInventaire")
     */
    private $inventaireArmures;

    public function __construct()
    {
        $this->CollArmures = new ArrayCollection();
        $this->inventaireArmures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEquipement(): ?string
    {
        return $this->nomEquipement;
    }

    public function setNomEquipement(string $nomEquipement): self
    {
        $this->nomEquipement = $nomEquipement;

        return $this;
    }



    /**
     * @return Collection|Armure[]
     */
    public function getCollArmures(): Collection
    {
        return $this->CollArmures;
    }

    public function addCollArmure(Armure $collArmure): self
    {
        if (!$this->CollArmures->contains($collArmure)) {
            $this->CollArmures[] = $collArmure;
            $collArmure->setEquipement($this);
        }

        return $this;
    }

    public function removeCollArmure(Armure $collArmure): self
    {
        if ($this->CollArmures->contains($collArmure)) {
            $this->CollArmures->removeElement($collArmure);
            // set the owning side to null (unless already changed)
            if ($collArmure->getEquipement() === $this) {
                $collArmure->setEquipement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|InventaireArmure[]
     */
    public function getInventaireArmures(): Collection
    {
        return $this->inventaireArmures;
    }

    public function addInventaireArmure(InventaireArmure $inventaireArmure): self
    {
        if (!$this->inventaireArmures->contains($inventaireArmure)) {
            $this->inventaireArmures[] = $inventaireArmure;
            $inventaireArmure->setEquipementInventaire($this);
        }

        return $this;
    }

    public function removeInventaireArmure(InventaireArmure $inventaireArmure): self
    {
        if ($this->inventaireArmures->contains($inventaireArmure)) {
            $this->inventaireArmures->removeElement($inventaireArmure);
            // set the owning side to null (unless already changed)
            if ($inventaireArmure->getEquipementInventaire() === $this) {
                $inventaireArmure->setEquipementInventaire(null);
            }
        }

        return $this;
    }
}
