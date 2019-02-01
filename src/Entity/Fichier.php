<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FichierRepository")
 */
class Fichier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    //variable qui permet de verifier  elements du fichier uploader////
    /**
     * @var string
     * @Assert\File(mimeTypes={ "application/pdf" ,"application/msword" , "application/vnd.openxmlformats-officedocument.wordprocessingml.document","image/jpeg", "image/png", "image/gif", "image/jpg"})
     */

    private $contenuFileBefore;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contenueFichier;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fichierExtension;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createFileAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $modifFileAt;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Item", inversedBy="fichier", cascade={"persist", "remove"})
     */
    private $item;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="maps")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenueFichier(): ?string
    {
        return $this->contenueFichier;
    }

    public function setContenueFichier(string $contenueFichier): self
    {
        $this->contenueFichier = $contenueFichier;

        return $this;
    }

    public function getFichierExtension(): ?string
    {
        return $this->fichierExtension;
    }

    public function setFichierExtension(string $fichierExtension): self
    {
        $this->fichierExtension = $fichierExtension;

        return $this;
    }

    public function getCreateFileAt(): ?\DateTimeInterface
    {
        return $this->createFileAt;
    }

    public function setCreateFileAt(\DateTimeInterface $createFileAt): self
    {
        $this->createFileAt = $createFileAt;

        return $this;
    }

    public function getModifFileAt(): ?\DateTimeInterface
    {
        return $this->modifFileAt;
    }

    public function setModifFileAt(?\DateTimeInterface $modifFileAt): self
    {
        $this->modifFileAt = $modifFileAt;

        return $this;
    }

    public function getItem(): ?Item
    {
        return $this->item;
    }

    public function setItem(?Item $item): self
    {
        $this->item = $item;

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

    /**
     * @return string
     */
    public function getContenuFileBefore(): string
    {
        return $this->contenuFileBefore;
    }

    /**
     * @param string $contenuFileBefore
     * @return Fichier
     */
    public function setContenuFileBefore(string $contenuFileBefore): Fichier
    {
        $this->contenuFileBefore = $contenuFileBefore;
        return $this;
    }


}
