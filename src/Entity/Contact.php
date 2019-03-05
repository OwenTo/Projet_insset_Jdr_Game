<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ContactRepository")
 */
class Contact
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
    private $nameContact;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $emailContact;

   

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SujetMail", inversedBy="contacts")
     */
    private $sujetMail;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(min=10)
     */
    private $message;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sujet;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createAt;



    public function __construct()
    {
        $this->createAt=new \DateTime('Now ', new \DateTimeZone('Europe/Paris'));
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameContact(): ?string
    {
        return $this->nameContact;
    }

    public function setNameContact(string $nameContact): self
    {
        $this->nameContact = $nameContact;

        return $this;
    }

    public function getEmailContact(): ?string
    {
        return $this->emailContact;
    }

    public function setEmailContact(string $emailContact): self
    {
        $this->emailContact = $emailContact;

        return $this;
    }



    public function getSujetMail(): ?SujetMail
    {
        return $this->sujetMail;
    }

    public function setSujetMail(?SujetMail $sujetMail): self
    {
        $this->sujetMail = $sujetMail;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getSujet(): ?string
    {
        return $this->sujet;
    }

    public function setSujet(?string $sujet): self
    {
        $this->sujet = $sujet;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeInterface $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }
}
