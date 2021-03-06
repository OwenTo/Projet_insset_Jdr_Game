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
 * @ORM\Entity(repositoryClass="App\Repository\InventaireItemRepository")
 * @InheritanceType("JOINED")
 * @DiscriminatorColumn(name="enfant", type="string")
 * @DiscriminatorMap({"inventaireItem" = "InventaireItem", "inventaireArme" = "InventaireArme","inventaireArmure"="InventaireArmure","inventaireMagie"="InventaireMagie"})
 */
class InventaireItem
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
    private $nomItemInventaire;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionItemInventaire;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $poidsItemInventaire;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $beneficeMaluceInventaire;

    /**
     * @ORM\Column(type="integer")
     */
    private $valeurInventaire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeDes", inversedBy="inventaireItems")
     */
    private $typesDes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Monnaie", inversedBy="inventaireItems")
     */
    private $monnaie;





    //variable qui permet de verifier  elements du fichier uploader////
    /**
     * @var string
     * @Assert\File(mimeTypes={"image/jpeg", "image/png", "image/gif", "image/jpg"})
     */
    private $imageAvInsertionInventaire;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Fichier", inversedBy="inventaireItem", cascade={"persist", "remove"})
     */
    private $fichier;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Inventaire", mappedBy="items")
     */
    private $inventaires;





    public function __construct()
    {
        $this->inventaires = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomItemInventaire(): ?string
    {
        return $this->nomItemInventaire;
    }

    public function setNomItemInventaire(string $nomItemInventaire): self
    {
        $this->nomItemInventaire = $nomItemInventaire;

        return $this;
    }

    public function getDescriptionItemInventaire(): ?string
    {
        return $this->descriptionItemInventaire;
    }

    public function setDescriptionItemInventaire(?string $descriptionItemInventaire): self
    {
        $this->descriptionItemInventaire = $descriptionItemInventaire;

        return $this;
    }

    public function getPoidsItemInventaire(): ?float
    {
        return $this->poidsItemInventaire;
    }

    public function setPoidsItemInventaire(?float $poidsItemInventaire): self
    {
        $this->poidsItemInventaire = $poidsItemInventaire;

        return $this;
    }

    public function getBeneficeMaluceInventaire(): ?string
    {
        return $this->beneficeMaluceInventaire;
    }

    public function setBeneficeMaluceInventaire(?string $beneficeMaluceInventaire): self
    {
        $this->beneficeMaluceInventaire = $beneficeMaluceInventaire;

        return $this;
    }

    public function getValeurInventaire(): ?int
    {
        return $this->valeurInventaire;
    }

    public function setValeurInventaire(int $valeurInventaire): self
    {
        $this->valeurInventaire = $valeurInventaire;

        return $this;
    }

    public function getTypesDes(): ?TypeDes
    {
        return $this->typesDes;
    }

    public function setTypesDes(?TypeDes $typesDes): self
    {
        $this->typesDes = $typesDes;

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



    /**
     * @return string
     */
    public function getImageAvInsertionInventaire(): string
    {
        return $this->imageAvInsertionInventaire;
    }

    /**
     * @param string $imageAvInsertionInventaire
     * @return InventaireItem
     */
    public function setImageAvInsertionInventaire(string $imageAvInsertionInventaire): InventaireItem
    {
        $this->imageAvInsertionInventaire = $imageAvInsertionInventaire;
        return $this;
    }

    public function getFichier(): ?Fichier
    {
        return $this->fichier;
    }

    public function setFichier(?Fichier $fichier): self
    {
        $this->fichier = $fichier;

        return $this;
    }

    /**
     * @return Collection|Inventaire[]
     */
    public function getInventaires(): Collection
    {
        return $this->inventaires;
    }

    public function addInventaire(Inventaire $inventaire): self
    {
        if (!$this->inventaires->contains($inventaire)) {
            $this->inventaires[] = $inventaire;
            $inventaire->setItems($this);
        }

        return $this;
    }

    public function removeInventaire(Inventaire $inventaire): self
    {
        if ($this->inventaires->contains($inventaire)) {
            $this->inventaires->removeElement($inventaire);
            // set the owning side to null (unless already changed)
            if ($inventaire->getItems() === $this) {
                $inventaire->setItems(null);
            }
        }

        return $this;
    }







}
