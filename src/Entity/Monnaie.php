<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MonnaieRepository")
 */
class Monnaie
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
    private $nomMonnaie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomMonnaie(): ?string
    {
        return $this->nomMonnaie;
    }

    public function setNomMonnaie(string $nomMonnaie): self
    {
        $this->nomMonnaie = $nomMonnaie;

        return $this;
    }
}
