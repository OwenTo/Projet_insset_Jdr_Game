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
//    private $joueurs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Invitation", mappedBy="partie", orphanRemoval=true)
     */
    private $invitations;

    public function __construct()
    {
        $this->invitations = new ArrayCollection();
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
}
