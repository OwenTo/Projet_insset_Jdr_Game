<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeTalentRepository")
 */
class TypeTalent
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
    private $nomTypeTalent;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Talent", mappedBy="typeTalent")
     */
    private $talents;

    public function __construct()
    {
        $this->talents = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomTypeTalent(): ?string
    {
        return $this->nomTypeTalent;
    }

    public function setNomTypeTalent(string $nomTypeTalent): self
    {
        $this->nomTypeTalent = $nomTypeTalent;

        return $this;
    }

    /**
     * @return Collection|Talent[]
     */
    public function getTalents(): Collection
    {
        return $this->talents;
    }

    public function addTalent(Talent $talent): self
    {
        if (!$this->talents->contains($talent)) {
            $this->talents[] = $talent;
            $talent->setTypeTalent($this);
        }

        return $this;
    }

    public function removeTalent(Talent $talent): self
    {
        if ($this->talents->contains($talent)) {
            $this->talents->removeElement($talent);
            // set the owning side to null (unless already changed)
            if ($talent->getTypeTalent() === $this) {
                $talent->setTypeTalent(null);
            }
        }

        return $this;
    }

   
}
