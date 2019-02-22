<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PersonnageRepository")
 */
class Personnage
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
    private $nomPersonnage;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $PrenomPersonnage;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $DescriptionPersonnege;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sexe;

    /**
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @ORM\Column(type="float")
     */
    private $poids;

    /**
     * @ORM\Column(type="float")
     */
    private $taille;

    /**
     * @ORM\Column(type="integer")
     */
    private $niveau;



    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Langue", inversedBy="personnages")
     */
    private $collLangues;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\NiveauMetier", mappedBy="personnage")
     */
    private $collNiveauMetier;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RangGuilde", mappedBy="personnage")
     */
    private $collRangGuilds;



    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ValeurCaract", mappedBy="personnage")
     */
    private $valeurCaract;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\InventaireBourse", cascade={"persist", "remove"})
     */
    private $inventaireBourse;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="personnages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;



    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ClassePersonnage", inversedBy="personnages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $classe;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Compagnon", inversedBy="personnages")
     */
    private $collCompagnons;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\InventaireItem", inversedBy="personnages")
     */
    private $inventaire;


//    /**
//     * @var string
//     */
//    private $guilde;

    /**
     * Personnage constructor.
     */



    public function __construct()
    {
        $this->collLangues = new ArrayCollection();
        $this->collNiveauMetier = new ArrayCollection();
        $this->collRangGuilds = new ArrayCollection();
        $this->collCompagnons = new ArrayCollection();
        $this->valeurCaract = new ArrayCollection();
        $this->inventaire = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPersonnage(): ?string
    {
        return $this->nomPersonnage;
    }

    public function setNomPersonnage(string $nomPersonnage): self
    {
        $this->nomPersonnage = $nomPersonnage;

        return $this;
    }

    public function getPrenomPersonnage(): ?string
    {
        return $this->PrenomPersonnage;
    }

    public function setPrenomPersonnage(string $PrenomPersonnage): self
    {
        $this->PrenomPersonnage = $PrenomPersonnage;

        return $this;
    }

    public function getDescriptionPersonnege(): ?string
    {
        return $this->DescriptionPersonnege;
    }

    public function setDescriptionPersonnege(?string $DescriptionPersonnege): self
    {
        $this->DescriptionPersonnege = $DescriptionPersonnege;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

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

    public function getTaille(): ?float
    {
        return $this->taille;
    }

    public function setTaille(float $taille): self
    {
        $this->taille = $taille;

        return $this;
    }

    public function getNiveau(): ?int
    {
        return $this->niveau;
    }

    public function setNiveau(int $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

  

    /**
     * @return Collection|Langue[]
     */
    public function getCollLangues(): Collection
    {
        return $this->collLangues;
    }

    public function addCollLangue(Langue $collLangue): self
    {
        if (!$this->collLangues->contains($collLangue)) {
            $this->collLangues[] = $collLangue;
        }

        return $this;
    }

    public function removeCollLangue(Langue $collLangue): self
    {
        if ($this->collLangues->contains($collLangue)) {
            $this->collLangues->removeElement($collLangue);
        }

        return $this;
    }

    /**
     * @return Collection|NiveauMetier[]
     */
    public function getCollNiveauMetier(): Collection
    {
        return $this->collNiveauMetier;
    }

    public function addCollNiveauMetier(NiveauMetier $collNiveauMetier): self
    {
        if (!$this->collNiveauMetier->contains($collNiveauMetier)) {
            $this->collNiveauMetier[] = $collNiveauMetier;
            $collNiveauMetier->setPersonnage($this);
        }

        return $this;
    }

    public function removeCollNiveauMetier(NiveauMetier $collNiveauMetier): self
    {
        if ($this->collNiveauMetier->contains($collNiveauMetier)) {
            $this->collNiveauMetier->removeElement($collNiveauMetier);
            // set the owning side to null (unless already changed)
            if ($collNiveauMetier->getPersonnage() === $this) {
                $collNiveauMetier->setPersonnage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RangGuilde[]
     */
    public function getCollRangGuilds(): Collection
    {
        return $this->collRangGuilds;
    }

    public function addCollRangGuild(RangGuilde $collRangGuild): self
    {
        if (!$this->collRangGuilds->contains($collRangGuild)) {
            $this->collRangGuilds[] = $collRangGuild;
            $collRangGuild->setPersonnage($this);
        }

        return $this;
    }

    public function removeCollRangGuild(RangGuilde $collRangGuild): self
    {
        if ($this->collRangGuilds->contains($collRangGuild)) {
            $this->collRangGuilds->removeElement($collRangGuild);
            // set the owning side to null (unless already changed)
            if ($collRangGuild->getPersonnage() === $this) {
                $collRangGuild->setPersonnage(null);
            }
        }

        return $this;
    }


    /**
     * @return Collection|ValeurCaract[]
     */
    public function getValeurCaract(): Collection
    {
        return $this->valeurCaract;
    }

    public function addValeurCaract(ValeurCaract $valeurCaract): self
    {
        if (!$this->valeurCaract->contains($valeurCaract)) {
            $this->valeurCaract[] = $valeurCaract;
            $valeurCaract->setPersonnage($this);
        }

        return $this;
    }

    public function removeValeurCaract(ValeurCaract $valeurCaract): self
    {
        if ($this->valeurCaract->contains($valeurCaract)) {
            $this->valeurCaract->removeElement($valeurCaract);
            // set the owning side to null (unless already changed)
            if ($valeurCaract->getPersonnage() === $this) {
                $valeurCaract->setPersonnage(null);
            }
        }

        return $this;
    }

    public function getInventaireBourse(): ?InventaireBourse
    {
        return $this->inventaireBourse;
    }

    public function setInventaireBourse(?InventaireBourse $inventaireBourse): self
    {
        $this->inventaireBourse = $inventaireBourse;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }



    public function getClasse(): ?ClassePersonnage
    {
        return $this->classe;
    }

    public function setClasse(?ClassePersonnage $classe): self
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * @return Collection|Compagnon[]
     */
    public function getCollCompagnons(): Collection
    {
        return $this->collCompagnons;
    }

    public function addCollCompagnon(Compagnon $collCompagnon): self
    {
        if (!$this->collCompagnons->contains($collCompagnon)) {
            $this->collCompagnons[] = $collCompagnon;
        }

        return $this;
    }

    public function removeCollCompagnon(Compagnon $collCompagnon): self
    {
        if ($this->collCompagnons->contains($collCompagnon)) {
            $this->collCompagnons->removeElement($collCompagnon);
        }

        return $this;
    }

    /**
     * @return Collection|InventaireItem[]
     */
    public function getInventaire(): Collection
    {
        return $this->inventaire;
    }

    public function addInventaire(InventaireItem $inventaire): self
    {
        if (!$this->inventaire->contains($inventaire)) {
            $this->inventaire[] = $inventaire;
        }

        return $this;
    }

    public function removeInventaire(InventaireItem $inventaire): self
    {
        if ($this->inventaire->contains($inventaire)) {
            $this->inventaire->removeElement($inventaire);
        }

        return $this;
    }

//
//    /**
//     * @return string
//     */
//    public function getGuilde()
//    {
//        return $this->guilde;
//    }
//
//    /**
//     * @param string $guilde
//     * @return Personnage
//     */
//    public function setGuilde(string $guilde): Personnage
//    {
//        $this->guilde = $guilde;
//        return $this;
//    }

}
