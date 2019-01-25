<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InventaireBourseRepository")
 */
class InventaireBourse
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
    private $valeurBoursePerso;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValeurBoursePerso(): ?int
    {
        return $this->valeurBoursePerso;
    }

    public function setValeurBoursePerso(int $valeurBoursePerso): self
    {
        $this->valeurBoursePerso = $valeurBoursePerso;

        return $this;
    }
}
