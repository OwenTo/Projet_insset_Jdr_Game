<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeGuildeRepository")
 */
class TypeGuilde
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
    private $typeGuilde;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Guilde", mappedBy="typeGuilde")
     */
    private $collTGuilde;

    public function __construct()
    {
        $this->collTGuilde = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeGuilde(): ?string
    {
        return $this->typeGuilde;
    }

    public function setTypeGuilde(string $typeGuilde): self
    {
        $this->typeGuilde = $typeGuilde;

        return $this;
    }

    /**
     * @return Collection|Guilde[]
     */
    public function getCollTGuilde(): Collection
    {
        return $this->collTGuilde;
    }

    public function addCollTGuilde(Guilde $collTGuilde): self
    {
        if (!$this->collTGuilde->contains($collTGuilde)) {
            $this->collTGuilde[] = $collTGuilde;
            $collTGuilde->setTypeGuilde($this);
        }

        return $this;
    }

    public function removeCollTGuilde(Guilde $collTGuilde): self
    {
        if ($this->collTGuilde->contains($collTGuilde)) {
            $this->collTGuilde->removeElement($collTGuilde);
            // set the owning side to null (unless already changed)
            if ($collTGuilde->getTypeGuilde() === $this) {
                $collTGuilde->setTypeGuilde(null);
            }
        }

        return $this;
    }
}
