<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

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
    private $collMArmure;

    public function __construct()
    {
        $this->collMArmes = new ArrayCollection();
        $this->collMArmure = new ArrayCollection();
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
    public function getCollMArmure(): Collection
    {
        return $this->collMArmure;
    }

    public function addCollMArmure(Armure $collMArmure): self
    {
        if (!$this->collMArmure->contains($collMArmure)) {
            $this->collMArmure[] = $collMArmure;
            $collMArmure->setMateriel($this);
        }

        return $this;
    }

    public function removeCollMArmure(Armure $collMArmure): self
    {
        if ($this->collMArmure->contains($collMArmure)) {
            $this->collMArmure->removeElement($collMArmure);
            // set the owning side to null (unless already changed)
            if ($collMArmure->getMateriel() === $this) {
                $collMArmure->setMateriel(null);
            }
        }

        return $this;
    }
}
