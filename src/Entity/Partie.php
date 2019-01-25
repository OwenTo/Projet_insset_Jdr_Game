<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PartieRepository")
 */
class Partie
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
    private $nomPartie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPartie(): ?string
    {
        return $this->nomPartie;
    }

    public function setNomPartie(string $nomPartie): self
    {
        $this->nomPartie = $nomPartie;

        return $this;
    }
}
