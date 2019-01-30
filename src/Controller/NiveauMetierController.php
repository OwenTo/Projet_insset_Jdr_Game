<?php

namespace App\Controller;

use App\Entity\NiveauMetier;
use App\Form\NiveauMetierType;
use App\Repository\NiveauMetierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/niveau/metier")
 */
class NiveauMetierController extends AbstractController
{
    /**
     * @Route("/", name="niveau_metier_index", methods={"GET"})
     */
    public function index(NiveauMetierRepository $niveauMetierRepository): Response
    {
        return $this->render('niveau_metier/index.html.twig', [
            'niveau_metiers' => $niveauMetierRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="niveau_metier_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $niveauMetier = new NiveauMetier();
        $form = $this->createForm(NiveauMetierType::class, $niveauMetier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($niveauMetier);
            $entityManager->flush();

            return $this->redirectToRoute('niveau_metier_index');
        }

        return $this->render('niveau_metier/new.html.twig', [
            'niveau_metier' => $niveauMetier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="niveau_metier_show", methods={"GET"})
     */
    public function show(NiveauMetier $niveauMetier): Response
    {
        return $this->render('niveau_metier/show.html.twig', [
            'niveau_metier' => $niveauMetier,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="niveau_metier_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, NiveauMetier $niveauMetier): Response
    {
        $form = $this->createForm(NiveauMetierType::class, $niveauMetier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('niveau_metier_index', [
                'id' => $niveauMetier->getId(),
            ]);
        }

        return $this->render('niveau_metier/edit.html.twig', [
            'niveau_metier' => $niveauMetier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="niveau_metier_delete", methods={"DELETE"})
     */
    public function delete(Request $request, NiveauMetier $niveauMetier): Response
    {
        if ($this->isCsrfTokenValid('delete'.$niveauMetier->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($niveauMetier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('niveau_metier_index');
    }
}
