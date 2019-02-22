<?php

namespace App\Controller;

use App\Entity\InventaireMagie;
use App\Form\InventaireMagieType;
use App\Repository\InventaireMagieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/inventaire/magie")
 */
class InventaireMagieController extends AbstractController
{
    /**
     * @Route("/", name="inventaire_magie_index", methods={"GET"})
     */
    public function index(InventaireMagieRepository $inventaireMagieRepository): Response
    {
        return $this->render('inventaire_magie/index.html.twig', [
            'inventaire_magies' => $inventaireMagieRepository->findAll(),
        ]);
    }

//    /**
//     * @Route("/new", name="inventaire_magie_new", methods={"GET","POST"})
//     */
//    public function new(Request $request): Response
//    {
//        $inventaireMagie = new InventaireMagie();
//        $form = $this->createForm(InventaireMagieType::class, $inventaireMagie);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->persist($inventaireMagie);
//            $entityManager->flush();
//
//            return $this->redirectToRoute('inventaire_magie_index');
//        }
//
//        return $this->render('inventaire_magie/new.html.twig', [
//            'inventaire_magie' => $inventaireMagie,
//            'form' => $form->createView(),
//        ]);
//    }

    /**
     * @Route("/{id}", name="inventaire_magie_show", methods={"GET"})
     */
    public function show(InventaireMagie $inventaireMagie): Response
    {
        return $this->render('inventaire_magie/show.html.twig', [
            'inventaire_magie' => $inventaireMagie,
        ]);
    }

//    /**
//     * @Route("/{id}/edit", name="inventaire_magie_edit", methods={"GET","POST"})
//     */
//    public function edit(Request $request, InventaireMagie $inventaireMagie): Response
//    {
//        $form = $this->createForm(InventaireMagieType::class, $inventaireMagie);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $this->getDoctrine()->getManager()->flush();
//
//            return $this->redirectToRoute('inventaire_magie_index', [
//                'id' => $inventaireMagie->getId(),
//            ]);
//        }
//
//        return $this->render('inventaire_magie/edit.html.twig', [
//            'inventaire_magie' => $inventaireMagie,
//            'form' => $form->createView(),
//        ]);
//    }
//
//    /**
//     * @Route("/{id}", name="inventaire_magie_delete", methods={"DELETE"})
//     */
//    public function delete(Request $request, InventaireMagie $inventaireMagie): Response
//    {
//        if ($this->isCsrfTokenValid('delete'.$inventaireMagie->getId(), $request->request->get('_token'))) {
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->remove($inventaireMagie);
//            $entityManager->flush();
//        }
//
//        return $this->redirectToRoute('inventaire_magie_index');
//    }



}
