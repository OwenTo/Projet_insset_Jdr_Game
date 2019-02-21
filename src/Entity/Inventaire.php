<?php
//
//namespace App\Entity;
//
//
//use Doctrine\Common\Collections\ArrayCollection;
//use Doctrine\Common\Collections\Collection;
//use Doctrine\ORM\Mapping as ORM;
//
///**
// * @ORM\Entity(repositoryClass="App\Repository\InventaireRepository")
// */
//class Inventaire
//{
//    /**
//     * @ORM\Id()
//     * @ORM\GeneratedValue()
//     * @ORM\Column(type="integer")
//     */
//    private $id;
//
//    /**
//     * @ORM\OneToOne(targetEntity="App\Entity\Personnage", mappedBy="inventaire", cascade={"persist", "remove"})
//     */
//    private $personnage;
//
//
//
//
//
//
//
//    public function getId(): ?int
//    {
//        return $this->id;
//    }
//
//    public function getPersonnage(): ?Personnage
//    {
//        return $this->personnage;
//    }
//
//    public function setPersonnage(?Personnage $personnage): self
//    {
//        $this->personnage = $personnage;
//
//        // set (or unset) the owning side of the relation if necessary
//        $newInventaire = $personnage === null ? null : $this;
//        if ($newInventaire !== $personnage->getInventaire()) {
//            $personnage->setInventaire($newInventaire);
//        }
//
//        return $this;
//    }
//
//
//
//
//}
