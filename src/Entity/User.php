<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
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
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="4",minMessage="votre mot de passe doit au moins faire 8 caractères")
     * @Assert\EqualTo(propertyPath="confirm_password", message="votre mot de passe ne correspond pas" )
     */
    private $password;

    /**
     * @Assert\EqualTo(propertyPath="confirm_password", message="votre mot de passe ne correspond pas" )
     */
    public $confirm_password;

    /**
     * @ORM\Column(type="array")
     */
    private $roles = [];

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Partie", mappedBy="utilisateur")
     */
    private $parties;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Personnage", mappedBy="user", orphanRemoval=true)
     */
    private $personnages;



    //variable qui permet de verifier  elements du fichier uploader////
    /**
     * @var string
     * @Assert\File(mimeTypes={"image/jpeg", "image/png", "image/gif", "image/jpg"})
     */
    private $mapsAvInsertion;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Fichier", mappedBy="user")
     */
    private $maps;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Partie", mappedBy="joueurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $partieRejoins;




    /**
     * @return mixed
     */
    public function getConfirmPassword()
    {
        return $this->confirm_password;
    }

    /**
     * @param mixed $confirm_password
     * @return User
     */
    public function setConfirmPassword($confirm_password)
    {
        $this->confirm_password = $confirm_password;
        return $this;
    }





    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function __construct()
    {
        $this->roles[]="ROLE_USER";
        $this->parties = new ArrayCollection();
        $this->personnages = new ArrayCollection();
        $this->maps = new ArrayCollection();
        $this->partieRejoins = new ArrayCollection();
//        $this->roles[]="ROLE_ADMIN";

    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    /**
     * @return Collection|Partie[]
     */
    public function getParties(): Collection
    {
        return $this->parties;
    }

    public function addParty(Partie $party): self
    {
        if (!$this->parties->contains($party)) {
            $this->parties[] = $party;
            $party->setUtilisateur($this);
        }

        return $this;
    }

    public function removeParty(Partie $party): self
    {
        if ($this->parties->contains($party)) {
            $this->parties->removeElement($party);
            // set the owning side to null (unless already changed)
            if ($party->getUtilisateur() === $this) {
                $party->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Personnage[]
     */
    public function getPersonnages(): Collection
    {
        return $this->personnages;
    }

    public function addPersonnage(Personnage $personnage): self
    {
        if (!$this->personnages->contains($personnage)) {
            $this->personnages[] = $personnage;
            $personnage->setUser($this);
        }

        return $this;
    }

    public function removePersonnage(Personnage $personnage): self
    {
        if ($this->personnages->contains($personnage)) {
            $this->personnages->removeElement($personnage);
            // set the owning side to null (unless already changed)
            if ($personnage->getUser() === $this) {
                $personnage->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Fichier[]
     */
    public function getMaps(): Collection
    {
        return $this->maps;
    }

    public function addMap(Fichier $map): self
    {
        if (!$this->maps->contains($map)) {
            $this->maps[] = $map;
            $map->setUser($this);
        }

        return $this;
    }

    public function removeMap(Fichier $map): self
    {
        if ($this->maps->contains($map)) {
            $this->maps->removeElement($map);
            // set the owning side to null (unless already changed)
            if ($map->getUser() === $this) {
                $map->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Partie[]
     */
    public function getPartieRejoins(): Collection
    {
        return $this->partieRejoins;
    }

    public function addPartieRejoin(Partie $partieRejoin): self
    {
        if (!$this->partieRejoins->contains($partieRejoin)) {
            $this->partieRejoins[] = $partieRejoin;
            $partieRejoin->addJoueur($this);
        }

        return $this;
    }

    public function removePartieRejoin(Partie $partieRejoin): self
    {
        if ($this->partieRejoins->contains($partieRejoin)) {
            $this->partieRejoins->removeElement($partieRejoin);
            $partieRejoin->removeJoueur($this);
        }

        return $this;
    }


}
