<?php

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InventaireRepository")
 */
class Inventaire
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\inventaireItem", inversedBy="inventaires")
     */
    private $items;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Personnage", inversedBy="inventaires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $personnage;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $categorie;
//
//    /**
//     * @ORM\Column(type="integer", nullable=true)
//     */
//    private $nbrArme;











    public function getId(): ?int
    {
        return $this->id;
    }


    public function getItems(): ?inventaireItem
    {
        return $this->items;
    }

    public function setItems(?inventaireItem $items): self
    {
        $this->items = $items;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getPersonnage(): ?Personnage
    {
        return $this->personnage;
    }

    public function setPersonnage(?Personnage $personnage): self
    {
        $this->personnage = $personnage;

        return $this;
    }

//    public function getNbrArme(): ?int
//    {
//        return $this->nbrArme;
//    }
//
//    public function setNbrArme(?int $nbrArme): self
//    {
//        $this->nbrArme = $nbrArme;
//
//        return $this;
//    }





}
