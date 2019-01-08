<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeDesRepository")
 */
class TypeDes
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
    private $des;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDes(): ?string
    {
        return $this->des;
    }

    public function setDes(string $des): self
    {
        $this->des = $des;

        return $this;
    }
}
