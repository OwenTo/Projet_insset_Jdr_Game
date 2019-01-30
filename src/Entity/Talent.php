<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\TalentRepository")
 */
class Talent
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionTalent;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomTalent;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $beneficeMaluceTalent;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescriptionTalent(): ?string
    {
        return $this->descriptionTalent;
    }

    public function setDescriptionTalent(?string $descriptionTalent): self
    {
        $this->descriptionTalent = $descriptionTalent;

        return $this;
    }

    public function getNomTalent(): ?string
    {
        return $this->nomTalent;
    }

    public function setNomTalent(string $nomTalent): self
    {
        $this->nomTalent = $nomTalent;

        return $this;
    }

    public function getBeneficeMaluceTalent(): ?string
    {
        return $this->beneficeMaluceTalent;
    }

    public function setBeneficeMaluceTalent(?string $beneficeMaluceTalent): self
    {
        $this->beneficeMaluceTalent = $beneficeMaluceTalent;

        return $this;
    }
}
