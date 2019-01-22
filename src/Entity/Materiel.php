<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MaterielRepository")
 */
class Materiel
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
    private $typeMateriel;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Arme", mappedBy="materiel")
     */
    private $collMArmes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Armure", mappedBy="materiel")
     */
    private $collArmure;



    public function __construct()
    {
        $this->collMArmes = new ArrayCollection();
        $this->collArmure = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeMateriel(): ?string
    {
        return $this->typeMateriel;
    }

    public function setTypeMateriel(string $typeMateriel): self
    {
        $this->typeMateriel = $typeMateriel;

        return $this;
    }

    /**
     * @return Collection|Arme[]
     */
    public function getCollMArmes(): Collection
    {
        return $this->collMArmes;
    }

    public function addCollMArme(Arme $collMArme): self
    {
        if (!$this->collMArmes->contains($collMArme)) {
            $this->collMArmes[] = $collMArme;
            $collMArme->setMateriel($this);
        }

        return $this;
    }

    public function removeCollMArme(Arme $collMArme): self
    {
        if ($this->collMArmes->contains($collMArme)) {
            $this->collMArmes->removeElement($collMArme);
            // set the owning side to null (unless already changed)
            if ($collMArme->getMateriel() === $this) {
                $collMArme->setMateriel(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Armure[]
     */
    public function getCollArmure(): Collection
    {
        return $this->collArmure;
    }

    public function addCollArmure(Armure $collArmure): self
    {
        if (!$this->collArmure->contains($collArmure)) {
            $this->collArmure[] = $collArmure;
            $collArmure->setMateriel($this);
        }

        return $this;
    }

    public function removeCollArmure(Armure $collArmure): self
    {
        if ($this->collArmure->contains($collArmure)) {
            $this->collArmure->removeElement($collArmure);
            // set the owning side to null (unless already changed)
            if ($collArmure->getMateriel() === $this) {
                $collArmure->setMateriel(null);
            }
        }

        return $this;
    }


}
