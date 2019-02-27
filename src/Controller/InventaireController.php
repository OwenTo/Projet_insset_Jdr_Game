<?php

namespace App\Controller;

use App\Entity\Inventaire;
use App\Entity\Personnage;
use App\Form\Inventaire1Type;
use App\Form\InventaireType;
use App\Form\PersonnageInventaireArmeType;
use App\Form\PersonnageInventaireArmureType;
use App\Form\PersonnageInventaireMagieType;
use App\Repository\InventaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/inventaire")
 */
class InventaireController extends AbstractController
{
    /**
     * @Route("/liste/{item}/personnage/{idPersonnage}/", name="inventaire_index_arme", methods={"GET"})
     * @Route("/liste/{item}/personnage/{idPersonnage}/", name="inventaire_index_armure", methods={"GET"})
     * @Route("/liste/{item}/personnage/{idPersonnage}/", name="inventaire_index_magie", methods={"GET"})
     */
    public function index(InventaireRepository $inventaireRepository, $item, Personnage $idPersonnage): Response
    {
        $personnage = $this->searchPersonnageAction($idPersonnage);
        $inventairesAll = $personnage->getInventaires();

        $inventairesItems = [];
        if ($item == "Armed") {
            foreach ($inventairesAll as $inventaire) {
                if ($inventaire->getCategorie() == "Armed") {
                    $inventairesItems[] = $inventaire;
                }

            }
            $title = "Arme";

        } elseif ($item == "Armor") {

            foreach ($inventairesAll as $inventaire) {
                if ($inventaire->getCategorie() == "Armor") {
                    $inventairesItems[] = $inventaire;
                }

            }
            $title = "Armure";

        } elseif ($item == "Magic") {

            foreach ($inventairesAll as $inventaire) {
                if ($inventaire->getCategorie() == "Magic") {
                    $inventairesItems[] = $inventaire;
                }


                $title = "Magique";
            }


        }
        return $this->render('inventaire/index.html.twig', [
            'title' => $title, 'personnage' => $personnage,
            'inventaires' => $inventairesItems,
        ]);

    }


    /**
     * @Route("/add/item/{categorie}/personnage/{idPersonnage}", name="inventaire_new_personnage_item_arme", methods={"GET","POST"})
     * @Route("/add/item/{categorie}/personnage/{idPersonnage}", name="inventaire_personnage_item_armure", methods={"GET","POST"})
     * @Route("/add/item/{categorie}/personnage/{idPersonnage}", name="inventaire_personnage_magie", methods={"GET","POST"})
     */
    public function newInventaireArme(Request $request, Personnage $idPersonnage, $categorie): Response
    {
        $personnage = $this->searchPersonnageAction($idPersonnage);
        $title = "";

        if ($categorie == "Armed") {
            $form = $this->createForm(PersonnageInventaireArmeType::class, $personnage);

        } elseif ($categorie == "Armor") {
            $form = $this->createForm(PersonnageInventaireArmureType::class, $personnage);

        } elseif ($categorie == "Magic") {
            $form = $this->createForm(PersonnageInventaireMagieType::class, $personnage);

        }


        $form->handleRequest($request);
//        var_dump($form);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();


            $items = $personnage->getItemsBefore();


            $redirect = "_";

            foreach ($items as $item) {
                $inventaire = new Inventaire();
                if ($categorie == "Armed") {
                    $inventaire->setCategorie("Armed");


                } elseif ($categorie == "Armor") {
                    $inventaire->setCategorie("Armor");


                } elseif ($categorie == "Magic") {
                    $inventaire->setCategorie("Magic");


                }
                $inventaire->setItems($item);
//

                $entityManager->persist($inventaire);

                $personnage->addInventaire($inventaire);
//
            }


            $entityManager->persist($personnage);
            $entityManager->flush();

            if ($categorie == "Armed") {

                $redirect .= 'arme';
                $title = "Arme";
            } elseif ($categorie == "Armor") {

                $redirect .= 'armure';
                $title = "Armure";
            } elseif ($categorie == "Magic") {

                $redirect .= 'magie';
                $title = "Magique";
            }


            return $this->redirectToRoute('inventaire_index' . $redirect,
                array('item' => $categorie,
                    'idPersonnage' => $personnage->getId(),

                ));
        }

        return $this->render('inventaire/new.html.twig', [
//                'inventaire' => $inventaire,
            'personnage' => $personnage,
            'categorie' => $categorie,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/detail/{id}", name="inventaire_show_personnage_item", methods={"GET"})
     */
    public function show(Inventaire $inventaire): Response
    {
        return $this->render('inventaire/show.html.twig', [
            'inventaire' => $inventaire,
        ]);
    }

//    /**
//     * @Route("/editer/{id}", name="inventaire_edit_personnage_item", methods={"GET","POST"})
//     */
//    public function edit(Request $request, Inventaire $inventaire): Response
//    {
//        $form = $this->createForm(InventaireType::class, $inventaire);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $this->getDoctrine()->getManager()->flush();
//
//            return $this->redirectToRoute('inventaire_index', [
//                'id' => $inventaire->getId(),
//            ]);
//        }
//
//        return $this->render('inventaire/edit.html.twig', [
//            'inventaire' => $inventaire,
//            'form' => $form->createView(),
//        ]);
//    }

    /**
     * @Route("/suppresser/{id}", name="inventaire_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Inventaire $inventaire): Response
    {

        $categorie = $inventaire->getCategorie();
        $personnageId = $inventaire->getPersonnage()->getId();
        $redirect = "_";
//var_dump($personnage);
        if ($this->isCsrfTokenValid('delete' . $inventaire->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($inventaire);
            $entityManager->flush();
        }


        if ($categorie == "Armed") {
            $redirect .= "arme";
        } elseif ($categorie == "Armor") {
            $redirect .= "armure";
        } elseif ($categorie == "Magic") {
            $redirect .= "magie";
        }

        return $this->redirectToRoute('inventaire_index' . $redirect,
            array('item' => $categorie,
                'idPersonnage' => $personnageId
            ));
    }


    private function searchPersonnageAction(Personnage $personnage)
    {
        $repositoryPersonnage = $this->getDoctrine()->getRepository('App:Personnage');
        //on récupère l'id de la siuation
        // on recuper les info d'une situation precise
        $infoPersonnage = $repositoryPersonnage->find($personnage);

        return $infoPersonnage;
    }
}
