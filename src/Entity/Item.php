<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\InheritanceType;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ItemRepository")

 * @InheritanceType("JOINED")
 * @DiscriminatorColumn(name="enfant", type="string")
 * @DiscriminatorMap({"item" = "Item", "arme" = "Arme","armure"="Armure","magie"="Magie"})
 */
class Item
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
    private $nomItem;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionItem;

    /**
     * @ORM\Column(type="float")
     */
    private $poids;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $beneficeMaluce;

    /**
     * @ORM\Column(type="integer")
     */
    private $valeur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeDes", inversedBy="collItems")
     */
    private $typeDes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Monnaie", inversedBy="collItems")
     */
    private $monnaie;


    //variable qui permet de verifier  elements du fichier uploader////
    /**
     * @var string
     * @Assert\File(mimeTypes={"image/jpeg", "image/png", "image/gif", "image/jpg"})
     */
    private $imageAvInsertion;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Fichier", mappedBy="item", cascade={"persist", "remove"})
     */
    private $fichier;




    public function __construct()
    {
        $this->inventaires = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getImageAvInsertion(): ?string
    {
        return $this->imageAvInsertion;
    }

    /**
     * @param string $imageAvInsertion
     * @return Item
     */
    public function setImageAvInsertion(string $imageAvInsertion): Item
    {
        $this->imageAvInsertion = $imageAvInsertion;
        return $this;
    }




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomItem(): ?string
    {
        return $this->nomItem;
    }

    public function setNomItem(string $nomItem): self
    {
        $this->nomItem = $nomItem;

        return $this;
    }

    public function getDescriptionItem(): ?string
    {
        return $this->descriptionItem;
    }

    public function setDescriptionItem(?string $descriptionItem): self
    {
        $this->descriptionItem = $descriptionItem;

        return $this;
    }

    public function getPoids(): ?float
    {
        return $this->poids;
    }

    public function setPoids(float $poids): self
    {
        $this->poids = $poids;

        return $this;
    }

    public function getBeneficeMaluce(): ?string
    {
        return $this->beneficeMaluce;
    }

    public function setBeneficeMaluce(?string $beneficeMaluce): self
    {
        $this->beneficeMaluce = $beneficeMaluce;

        return $this;
    }

    public function getValeur(): ?int
    {
        return $this->valeur;
    }

    public function setValeur(int $valeur): self
    {
        $this->valeur = $valeur;

        return $this;
    }

    public function getTypeDes(): ?TypeDes
    {
        return $this->typeDes;
    }

    public function setTypeDes(?TypeDes $typeDes): self
    {
        $this->typeDes = $typeDes;

        return $this;
    }

    public function getMonnaie(): ?Monnaie
    {
        return $this->monnaie;
    }

    public function setMonnaie(?Monnaie $monnaie): self
    {
        $this->monnaie = $monnaie;

        return $this;
    }

    public function getFichier(): ?Fichier
    {
        return $this->fichier;
    }

    public function setFichier(?Fichier $fichier): self
    {
        $this->fichier = $fichier;

        // set (or unset) the owning side of the relation if necessary
        $newItem = $fichier === null ? null : $this;
        if ($newItem !== $fichier->getItem()) {
            $fichier->setItem($newItem);
        }

        return $this;
    }



}
