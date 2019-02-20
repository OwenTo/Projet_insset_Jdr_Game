<?php

namespace App\Controller;

use App\Entity\CaracteristiqueSecondaire;
use App\Form\CaracteristiqueSecondaireType;
use App\Repository\CaracteristiqueSecondaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/caracteristique/secondaire")
 */
class CaracteristiqueSecondaireController extends AbstractController
{
    /**
     * @Route("/", name="caracteristique_secondaire_index", methods={"GET"})
     */
    public function index(CaracteristiqueSecondaireRepository $caracteristiqueSecondaireRepository): Response
    {
        return $this->render('caracteristique_secondaire/index.html.twig', [
            'caracteristique_secondaires' => $caracteristiqueSecondaireRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="caracteristique_secondaire_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $caracteristiqueSecondaire = new CaracteristiqueSecondaire();
        $form = $this->createForm(CaracteristiqueSecondaireType::class, $caracteristiqueSecondaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($caracteristiqueSecondaire);
            $entityManager->flush();

            return $this->redirectToRoute('caracteristique_secondaire_index');
        }

        return $this->render('caracteristique_secondaire/new.html.twig', [
            'caracteristique_secondaire' => $caracteristiqueSecondaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="caracteristique_secondaire_show", methods={"GET"})
     */
    public function show(CaracteristiqueSecondaire $caracteristiqueSecondaire): Response
    {
        return $this->render('caracteristique_secondaire/show.html.twig', [
            'caracteristique_secondaire' => $caracteristiqueSecondaire,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="caracteristique_secondaire_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CaracteristiqueSecondaire $caracteristiqueSecondaire): Response
    {
        $form = $this->createForm(CaracteristiqueSecondaireType::class, $caracteristiqueSecondaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('caracteristique_secondaire_index', [
                'id' => $caracteristiqueSecondaire->getId(),
            ]);
        }

        return $this->render('caracteristique_secondaire/edit.html.twig', [
            'caracteristique_secondaire' => $caracteristiqueSecondaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="caracteristique_secondaire_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CaracteristiqueSecondaire $caracteristiqueSecondaire): Response
    {
        if ($this->isCsrfTokenValid('delete'.$caracteristiqueSecondaire->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($caracteristiqueSecondaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('caracteristique_secondaire_index');
    }
}
