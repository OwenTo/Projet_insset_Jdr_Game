<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NiveauMetierRepository")
 */
class NiveauMetier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $niveauMetier;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Metier", inversedBy="niveauMetiers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $metier;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNiveauMetier(): ?int
    {
        return $this->niveauMetier;
    }

    public function setNiveauMetier(int $niveauMetier): self
    {
        $this->niveauMetier = $niveauMetier;

        return $this;
    }

    public function getMetier(): ?Metier
    {
        return $this->metier;
    }

    public function setMetier(?Metier $metier): self
    {
        $this->metier = $metier;

        return $this;
    }
}
