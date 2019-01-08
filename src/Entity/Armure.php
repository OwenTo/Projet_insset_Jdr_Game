<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArmureRepository")
 */
class Armure
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
    private $defense;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDefense(): ?string
    {
        return $this->defense;
    }

    public function setDefense(string $defense): self
    {
        $this->defense = $defense;

        return $this;
    }
}
