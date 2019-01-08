<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeMagieRepository")
 */
class TypeMagie
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
    private $nomTypeMagie;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Magie", inversedBy="typeMagies")
     */
    private $collMagie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomTypeMagie(): ?string
    {
        return $this->nomTypeMagie;
    }

    public function setNomTypeMagie(string $nomTypeMagie): self
    {
        $this->nomTypeMagie = $nomTypeMagie;

        return $this;
    }

    public function getCollMagie(): ?Magie
    {
        return $this->collMagie;
    }

    public function setCollMagie(?Magie $collMagie): self
    {
        $this->collMagie = $collMagie;

        return $this;
    }
}
