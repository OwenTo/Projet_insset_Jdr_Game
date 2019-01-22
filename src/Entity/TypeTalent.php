<?php

namespace App\Entity;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\Talent")
     */
    private $collTalent;

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

    public function getCollTalent(): ?Talent
    {
        return $this->collTalent;
    }

    public function setCollTalent(?Talent $collTalent): self
    {
        $this->collTalent = $collTalent;

        return $this;
    }
}
