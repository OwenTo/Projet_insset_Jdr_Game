<?php

namespace App\Controller;

use App\Entity\CapaciteRacial;
use App\Form\CapaciteRacialType;
use App\Repository\CapaciteRacialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/capacite/racial")
 */
class CapaciteRacialController extends AbstractController
{
    /**
     * @Route("/", name="capacite_racial_index", methods={"GET"})
     */
    public function index(CapaciteRacialRepository $capaciteRacialRepository): Response
    {
        return $this->render('capacite_racial/index.html.twig', [
            'capacite_racials' => $capaciteRacialRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="capacite_racial_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $capaciteRacial = new CapaciteRacial();
        $form = $this->createForm(CapaciteRacialType::class, $capaciteRacial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($capaciteRacial);
            $entityManager->flush();

            return $this->redirectToRoute('capacite_racial_index');
        }

        return $this->render('capacite_racial/new.html.twig', [
            'capacite_racial' => $capaciteRacial,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="capacite_racial_show", methods={"GET"})
     */
    public function show(CapaciteRacial $capaciteRacial): Response
    {
        return $this->render('capacite_racial/show.html.twig', [
            'capacite_racial' => $capaciteRacial,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="capacite_racial_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CapaciteRacial $capaciteRacial): Response
    {
        $form = $this->createForm(CapaciteRacialType::class, $capaciteRacial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('capacite_racial_index', [
                'id' => $capaciteRacial->getId(),
            ]);
        }

        return $this->render('capacite_racial/edit.html.twig', [
            'capacite_racial' => $capaciteRacial,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="capacite_racial_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CapaciteRacial $capaciteRacial): Response
    {
        if ($this->isCsrfTokenValid('delete'.$capaciteRacial->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($capaciteRacial);
            $entityManager->flush();
        }

        return $this->redirectToRoute('capacite_racial_index');
    }
}
