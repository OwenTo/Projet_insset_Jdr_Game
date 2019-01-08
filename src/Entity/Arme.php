<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArmeRepository")
 */
class Arme extends Item
{


    /**
     * @ORM\Column(type="string")
     */
    private $degat;



    public function setDegat(string $degat): self
    {
        $this->degat = $degat;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDegat()
    {
        return $this->degat;
    }
}
