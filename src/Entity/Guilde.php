<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GuildeRepository")
 */
class Guilde
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
    private $nomGuilde;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $MaitreGuilde;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeGuilde", inversedBy="collTGuilde")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeGuilde;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomGuilde(): ?string
    {
        return $this->nomGuilde;
    }

    public function setNomGuilde(string $nomGuilde): self
    {
        $this->nomGuilde = $nomGuilde;

        return $this;
    }

    public function getMaitreGuilde(): ?string
    {
        return $this->MaitreGuilde;
    }

    public function setMaitreGuilde(string $MaitreGuilde): self
    {
        $this->MaitreGuilde = $MaitreGuilde;

        return $this;
    }

    public function getTypeGuilde(): ?TypeGuilde
    {
        return $this->typeGuilde;
    }

    public function setTypeGuilde(?TypeGuilde $typeGuilde): self
    {
        $this->typeGuilde = $typeGuilde;

        return $this;
    }
}
