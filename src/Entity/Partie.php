<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PartieRepository")
 */
class Partie
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
    private $nomPartie;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="parties")
     */
    private $utilisateur;

//    /**
//     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="partieRejoins")
//     * @ORM\JoinColumn(nullable=false)
//     */
    private $joueurs=[];

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Invitation", mappedBy="partie", orphanRemoval=true)
     */
    private $invitations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ChoixPersonnage", mappedBy="partie", orphanRemoval=true)
     */
    private $choixPersonnages;

    public function __construct()
    {
        $this->joueurs=new ArrayCollection();
        $this->invitations = new ArrayCollection();
        $this->choixPersonnages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPartie(): ?string
    {
        return $this->nomPartie;
    }

    public function setNomPartie(string $nomPartie): self
    {
        $this->nomPartie = $nomPartie;

        return $this;
    }

    public function getUtilisateur(): ?User
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?User $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }


    /**
     * @return Collection|Invitation[]
     */
    public function getInvitations(): Collection
    {
        return $this->invitations;
    }

    public function addInvitation(Invitation $invitation): self
    {
        if (!$this->invitations->contains($invitation)) {
            $this->invitations[] = $invitation;
            $invitation->setPartie($this);
        }

        return $this;
    }

    public function removeInvitation(Invitation $invitation): self
    {
        if ($this->invitations->contains($invitation)) {
            $this->invitations->removeElement($invitation);
            // set the owning side to null (unless already changed)
            if ($invitation->getPartie() === $this) {
                $invitation->setPartie(null);
            }
        }

        return $this;
    }

    /**
     * @return array|ArrayCollection
     */
    public function getJoueurs()
    {
        return $this->joueurs;
    }

    /**
     * @param array|ArrayCollection $joueurs
     * @return Partie
     */
    public function setJoueurs($joueurs)
    {
        $this->joueurs = $joueurs;
        return $this;
    }

    /**
     * @return Collection|ChoixPersonnage[]
     */
    public function getChoixPersonnages(): Collection
    {
        return $this->choixPersonnages;
    }

    public function addChoixPersonnage(ChoixPersonnage $choixPersonnage): self
    {
        if (!$this->choixPersonnages->contains($choixPersonnage)) {
            $this->choixPersonnages[] = $choixPersonnage;
            $choixPersonnage->setPartie($this);
        }

        return $this;
    }

    public function removeChoixPersonnage(ChoixPersonnage $choixPersonnage): self
    {
        if ($this->choixPersonnages->contains($choixPersonnage)) {
            $this->choixPersonnages->removeElement($choixPersonnage);
            // set the owning side to null (unless already changed)
            if ($choixPersonnage->getPartie() === $this) {
                $choixPersonnage->setPartie(null);
            }
        }

        return $this;
    }




}
