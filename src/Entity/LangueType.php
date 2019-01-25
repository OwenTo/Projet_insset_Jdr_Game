<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LangueTypeRepository")
 */
class LangueType
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
    private $langueType;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Langue", inversedBy="langueTypes")
     */
    private $collLangues;

    public function __construct()
    {
        $this->collLangues = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLangueType(): ?string
    {
        return $this->langueType;
    }

    public function setLangueType(string $langueType): self
    {
        $this->langueType = $langueType;

        return $this;
    }

    /**
     * @return Collection|Langue[]
     */
    public function getCollLangues(): Collection
    {
        return $this->collLangues;
    }

    public function addCollLangue(Langue $collLangue): self
    {
        if (!$this->collLangues->contains($collLangue)) {
            $this->collLangues[] = $collLangue;
        }

        return $this;
    }

    public function removeCollLangue(Langue $collLangue): self
    {
        if ($this->collLangues->contains($collLangue)) {
            $this->collLangues->removeElement($collLangue);
        }

        return $this;
    }
}
