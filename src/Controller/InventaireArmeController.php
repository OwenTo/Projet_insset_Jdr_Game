<?php

namespace App\Controller;

use App\Entity\InventaireArme;
use App\Entity\Personnage;
use App\Form\InventaireArmeType;
use App\Form\PersonnageInventaireArmeType;
use App\Repository\InventaireArmeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class InventaireArmeController extends AbstractController
{
    /**
     * @Route("/liste/inventaire/arme", name="inventaire_arme_index", methods={"GET"})
     */
    public function index(InventaireArmeRepository $inventaireArmeRepository): Response
    {
        return $this->render('inventaire_arme/index.html.twig', [
            'inventaire_armes' => $inventaireArmeRepository->findAll(),
        ]);
    }

//    /**
//     * @Route("/new", name="inventaire_arme_new", methods={"GET","POST"})
//     */
//    public function new(Request $request): Response
//    {
//        $inventaireArme = new InventaireArme();
//        $form = $this->createForm(InventaireArmeType::class, $inventaireArme);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->persist($inventaireArme);
//            $entityManager->flush();
//
//            return $this->redirectToRoute('inventaire_arme_index');
//        }
//
//        return $this->render('inventaire_arme/new.html.twig', [
//            'inventaire_arme' => $inventaireArme,
//            'form' => $form->createView(),
//        ]);
//    }

    /**
     * @Route("/{id}", name="inventaire_arme_show", methods={"GET"})
     */
    public function show(InventaireArme $inventaireArme): Response
    {
        return $this->render('inventaire_arme/show.html.twig', [
            'inventaire_arme' => $inventaireArme,
        ]);
    }

//    /**
//     * @Route("/{id}/edit", name="inventaire_arme_edit", methods={"GET","POST"})
//     */
//    public function edit(Request $request, InventaireArme $inventaireArme): Response
//    {
//        $form = $this->createForm(InventaireArmeType::class, $inventaireArme);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $this->getDoctrine()->getManager()->flush();
//
//            return $this->redirectToRoute('inventaire_arme_index', [
//                'id' => $inventaireArme->getId(),
//            ]);
//        }
//
//        return $this->render('inventaire_arme/edit.html.twig', [
//            'inventaire_arme' => $inventaireArme,
//            'form' => $form->createView(),
//        ]);
//    }

//    /**
//     * @Route("/{id}", name="inventaire_arme_delete", methods={"DELETE"})
//     */
//    public function delete(Request $request, InventaireArme $inventaireArme): Response
//    {
//        if ($this->isCsrfTokenValid('delete'.$inventaireArme->getId(), $request->request->get('_token'))) {
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->remove($inventaireArme);
//            $entityManager->flush();
//        }
//
//        return $this->redirectToRoute('inventaire_arme_index');
//    }


    /**
     * @Route("/add/item/arme/personnage/{idPersonnage}",name="personnage_inventaire_arme", methods={"GET","POST"})
     * @param Request $request
     * @param Personnage $idPersonnage
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
public function addArmeAtPersonnnage(Request $request ,Personnage $idPersonnage){
    $personnage=$this->searchPersonnageAction($idPersonnage);

    $form = $this->createForm(PersonnageInventaireArmeType::class, $personnage);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($personnage);

        $entityManager->flush();
        return $this->redirectToRoute('inventaire_arme_index');


    }
    return $this->render('inventaire_arme/new.html.twig', [
//            'inventaire_arme' => $inventaireArme,
            'form' => $form->createView(),
        ]);

}




    private function searchPersonnageAction(Personnage $personnage)
    {
        $repositoryPersonnage = $this->getDoctrine()->getRepository('App:Personnage');
        //on récupère l'id de la siuation
        // on recuper les info d'une situation precise
        $infoPersonnage = $repositoryPersonnage->find($personnage);

        return $infoPersonnage;
    }



    /**
     * @Route("/liste/inventaire/arme/personnage/{idPersonnage}", name="inventaire_arme_personnage_index", methods={"GET"})
     */
    public function indexPersonnageArme(Personnage $idPersonnage): Response
    {
        $personnage=$this->searchPersonnageAction($idPersonnage);
        $repositoryPersonnage = $this->getDoctrine()->getRepository('App:Personnage');

        $inventaires =$repositoryPersonnage->findInventaireArme($personnage->getId());
        return $this->render('inventaire_arme/index.html.twig', [
            'inventaire_armes' =>$inventaires,
//            'inventaire_armes' => $inventaireArmeRepository->findAll(),
        ]);
    }


}
