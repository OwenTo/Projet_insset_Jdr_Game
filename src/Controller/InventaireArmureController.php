<?php

namespace App\Controller;

use App\Entity\InventaireArmure;
use App\Entity\Personnage;
use App\Form\InventaireArmureType;
use App\Form\PersonnageInventaireArmureType;
use App\Repository\InventaireArmureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/inventaire/armure")
 */
class InventaireArmureController extends AbstractController
{
    /**
     * @Route("/", name="inventaire_armure_index", methods={"GET"})
     */
    public function index(InventaireArmureRepository $inventaireArmureRepository): Response
    {
        return $this->render('inventaire_armure/index.html.twig', [
            'inventaire_armures' => $inventaireArmureRepository->findAll(),
        ]);
    }

    /**
//     * @Route("/new", name="inventaire_armure_new", methods={"GET","POST"})
//     */
//    public function new(Request $request): Response
//    {
//        $inventaireArmure = new InventaireArmure();
//        $form = $this->createForm(InventaireArmureType::class, $inventaireArmure);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->persist($inventaireArmure);
//            $entityManager->flush();
//
//            return $this->redirectToRoute('inventaire_armure_index');
//        }
//
//        return $this->render('inventaire_armure/new.html.twig', [
//            'inventaire_armure' => $inventaireArmure,
//            'form' => $form->createView(),
//        ]);
//    }

    /**
     * @Route("/{id}", name="inventaire_armure_show", methods={"GET"})
     */
    public function show(InventaireArmure $inventaireArmure): Response
    {
        return $this->render('inventaire_armure/show.html.twig', [
            'inventaire_armure' => $inventaireArmure,
        ]);
    }

//    /**
//     * @Route("/{id}/edit", name="inventaire_armure_edit", methods={"GET","POST"})
//     */
//    public function edit(Request $request, InventaireArmure $inventaireArmure): Response
//    {
//        $form = $this->createForm(InventaireArmureType::class, $inventaireArmure);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $this->getDoctrine()->getManager()->flush();
//
//            return $this->redirectToRoute('inventaire_armure_index', [
//                'id' => $inventaireArmure->getId(),
//            ]);
//        }
//
//        return $this->render('inventaire_armure/edit.html.twig', [
//            'inventaire_armure' => $inventaireArmure,
//            'form' => $form->createView(),
//        ]);
//    }
//
//    /**
//     * @Route("/{id}", name="inventaire_armure_delete", methods={"DELETE"})
//     */
//    public function delete(Request $request, InventaireArmure $inventaireArmure): Response
//    {
//        if ($this->isCsrfTokenValid('delete'.$inventaireArmure->getId(), $request->request->get('_token'))) {
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->remove($inventaireArmure);
//            $entityManager->flush();
//        }
//
//        return $this->redirectToRoute('inventaire_armure_index');
//    }





    /**
     * @Route("/add/inventaire/armure/personnage/{idPersonnage}",name="personnage_inventaire_armure", methods={"GET","POST"})
     * @param Request $request
     * @param Personnage $idPersonnage
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function addArmeAtPersonnnage(Request $request ,Personnage $idPersonnage){
        $personnage=$this->searchPersonnageAction($idPersonnage);

        $form = $this->createForm(PersonnageInventaireArmureType::class, $personnage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($personnage);

            $entityManager->flush();
            return $this->redirectToRoute('inventaire_arme_index');


        }
        return $this->render('inventaire_armure/new.html.twig', [
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
     * @Route("/liste/inventaire/armure/personnage/{idPersonnage}", name="inventaire_armure_personnage_index", methods={"GET"})
     * @param Personnage $idPersonnage
     * @return Response
     */
    public function indexPersonnageArme(Personnage $idPersonnage): Response
    {
        $personnage=$this->searchPersonnageAction($idPersonnage);
        $repositoryPersonnage = $this->getDoctrine()->getRepository('App:Personnage');

        $inventaires =$repositoryPersonnage->findInventaireArmure($personnage->getId());
        return $this->render('inventaire_armure/index.html.twig', [
            'inventaire_armures' =>$inventaires,
//            'inventaire_armes' => $inventaireArmeRepository->findAll(),
        ]);
    }


}
