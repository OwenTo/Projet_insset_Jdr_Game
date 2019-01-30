<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

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
    private $collEArmure;

    public function __construct()
    {
        $this->collEArmure = new ArrayCollection();
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
    public function getCollEArmure(): Collection
    {
        return $this->collEArmure;
    }

    public function addCollEArmure(Armure $collEArmure): self
    {
        if (!$this->collEArmure->contains($collEArmure)) {
            $this->collEArmure[] = $collEArmure;
            $collEArmure->setEquipement($this);
        }

        return $this;
    }

    public function removeCollEArmure(Armure $collEArmure): self
    {
        if ($this->collEArmure->contains($collEArmure)) {
            $this->collEArmure->removeElement($collEArmure);
            // set the owning side to null (unless already changed)
            if ($collEArmure->getEquipement() === $this) {
                $collEArmure->setEquipement(null);
            }
        }

        return $this;
    }
}
