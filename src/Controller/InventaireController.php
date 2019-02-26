<?php

namespace App\Controller;

use App\Entity\Inventaire;
use App\Entity\Personnage;
use App\Form\Inventaire1Type;
use App\Form\InventaireType;
use App\Form\PersonnageInventaireArmeType;
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
     * @Route("/liste", name="inventaire_index", methods={"GET"})
     */
    public function index(InventaireRepository $inventaireRepository): Response
    {
        return $this->render('inventaire/index.html.twig', [
            'inventaires' => $inventaireRepository->findAll(),
        ]);
    }


    /**
     * @Route("/add/personnage/item/armed/{idPersonnage}", name="inventaire_new_personnage_item_arme", methods={"GET","POST"})
     */
    public function newInventaireArme(Request $request, Personnage $idPersonnage): Response
    {
        $personnage = $this->searchPersonnageAction($idPersonnage);


//        $inventaire = new Inventaire();
        $form = $this->createForm(PersonnageInventaireArmeType::class, $personnage);
        $form->handleRequest($request);
//        var_dump($form);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();


            $items =$personnage->getItemsBefore();

//            var_dump($items);
            foreach ($items as $item) {
                $inventaire = new Inventaire();
                $inventaire->setCategorie("Armed");
                $inventaire->setItems($item);
//                $inventaire->setNbrArme($personnage->getNbrArmePosseder());

                $entityManager->persist($inventaire);

                $personnage->addInventaire($inventaire);
//
            }



                $entityManager->persist($personnage);
                $entityManager->flush();

                return $this->redirectToRoute('inventaire_index');
            }

            return $this->render('inventaire/new.html.twig', [
//                'inventaire' => $inventaire,
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

    /**
     * @Route("/editer/{id}", name="inventaire_edit_personnage_item", methods={"GET","POST"})
     */
    public function edit(Request $request, Inventaire $inventaire): Response
    {
        $form = $this->createForm(Inventaire1Type::class, $inventaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('inventaire_index', [
                'id' => $inventaire->getId(),
            ]);
        }

        return $this->render('inventaire/edit.html.twig', [
            'inventaire' => $inventaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/suppression/{id}", name="inventaire_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Inventaire $inventaire): Response
    {
        if ($this->isCsrfTokenValid('delete'.$inventaire->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($inventaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('inventaire_index');
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
