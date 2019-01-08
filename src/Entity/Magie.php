<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MagieRepository")
 */
class Magie extends Item
{

    /**
     * @ORM\Column(type="integer")
     */
    private $degatMagie;

    /**
     * @ORM\Column(type="integer")
     */
    private $coutDeMana;

    /**
     * @ORM\Column(type="integer")
     */
    private $niveauMagie;


    public function setDegatMagie(string $degatMagie): self
    {
        $this->degatMagie = $degatMagie;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDegatMagie()
    {
        return $this->degatMagie;
    }

    public function getCoutDeMana(): ?int
    {
        return $this->coutDeMana;
    }

    public function setCoutDeMana(int $coutDeMana): self
    {
        $this->coutDeMana = $coutDeMana;

        return $this;
    }

    public function getNiveauMagie(): ?int
    {
        return $this->niveauMagie;
    }

    public function setNiveauMagie(int $niveauMagie): self
    {
        $this->niveauMagie = $niveauMagie;

        return $this;
    }
}
