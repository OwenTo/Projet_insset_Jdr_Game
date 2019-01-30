<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RangGuildeRepository")
 */
class RangGuilde
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
    private $rang;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Guilde", inversedBy="rangGuildes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $guilde;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Personnage", inversedBy="collRangGuilds")
     */
    private $personnage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRang(): ?string
    {
        return $this->rang;
    }

    public function setRang(string $rang): self
    {
        $this->rang = $rang;

        return $this;
    }

    public function getGuilde(): ?Guilde
    {
        return $this->guilde;
    }

    public function setGuilde(?Guilde $guilde): self
    {
        $this->guilde = $guilde;

        return $this;
    }

    public function getPersonnage(): ?Personnage
    {
        return $this->personnage;
    }

    public function setPersonnage(?Personnage $personnage): self
    {
        $this->personnage = $personnage;

        return $this;
    }
}
