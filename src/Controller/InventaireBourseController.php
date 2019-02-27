<?php

namespace App\Controller;

use App\Entity\InventaireBourse;
use App\Form\InventaireBourseType;
use App\Repository\InventaireBourseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class InventaireBourseController extends AbstractController
{
    /**
     * @Route("/liste/inventaire/bourse", name="inventaire_bourse_index", methods={"GET"})
     */
    public function index(InventaireBourseRepository $inventaireBourseRepository): Response
    {
        return $this->render('inventaire_bourse/index.html.twig', [
            'inventaire_bourses' => $inventaireBourseRepository->findAll(),
        ]);
    }

    /**
     * @Route("/create/inventaire/bourse", name="inventaire_bourse_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $inventaireBourse = new InventaireBourse();
        $form = $this->createForm(InventaireBourseType::class, $inventaireBourse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($inventaireBourse);
            $entityManager->flush();

            return $this->redirectToRoute('inventaire_bourse_index');
        }

        return $this->render('inventaire_bourse/new.html.twig', [
            'inventaire_bourse' => $inventaireBourse,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/detail/inventaire/bourse/{id}", name="inventaire_bourse_show", methods={"GET"})
     */
    public function show(InventaireBourse $inventaireBourse): Response
    {
        return $this->render('inventaire_bourse/show.html.twig', [
            'inventaire_bourse' => $inventaireBourse,
        ]);
    }

    /**
     * @Route("/edit/inventaire/bourse/{id}", name="inventaire_bourse_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, InventaireBourse $inventaireBourse): Response
    {
        $form = $this->createForm(InventaireBourseType::class, $inventaireBourse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('inventaire_bourse_index', [
                'id' => $inventaireBourse->getId(),
            ]);
        }

        return $this->render('inventaire_bourse/edit.html.twig', [
            'inventaire_bourse' => $inventaireBourse,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/suppression/inventaire/bourse/{id}", name="inventaire_bourse_delete", methods={"DELETE"})
     */
    public function delete(Request $request, InventaireBourse $inventaireBourse): Response
    {
        if ($this->isCsrfTokenValid('delete'.$inventaireBourse->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($inventaireBourse);
            $entityManager->flush();
        }

        return $this->redirectToRoute('inventaire_bourse_index');
    }
}
