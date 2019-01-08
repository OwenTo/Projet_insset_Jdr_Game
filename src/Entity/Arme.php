<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArmeRepository")
 */
class Arme extends Item
{


    /**
     * @ORM\Column(type="integer")
     */
    private $degat;



    public function setDegat(int $degat): self
    {
        $this->degat = $degat;

        return $this;
    }
}
