<?php

namespace App\Controller;

use App\Entity\CaracteristiquePrincipal;
use App\Form\CaracteristiquePrincipalType;
use App\Repository\CaracteristiquePrincipalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CaracteristiquePrincipalController extends AbstractController
{
    /**
     * @Route("/liste/caracteristique/principal", name="caracteristique_principal_index", methods={"GET"})
     */
    public function index(CaracteristiquePrincipalRepository $caracteristiquePrincipalRepository): Response
    {
        return $this->render('caracteristique_principal/index.html.twig', [
            'caracteristique_principals' => $caracteristiquePrincipalRepository->findAll(),
        ]);
    }

    /**
     * @Route("/create/caracteristique/principal", name="caracteristique_principal_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $caracteristiquePrincipal = new CaracteristiquePrincipal();
        $form = $this->createForm(CaracteristiquePrincipalType::class, $caracteristiquePrincipal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($caracteristiquePrincipal);
            $entityManager->flush();

            return $this->redirectToRoute('caracteristique_principal_index');
        }

        return $this->render('caracteristique_principal/new.html.twig', [
            'caracteristique_principal' => $caracteristiquePrincipal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/detail/caracteristique/principal/{id}", name="caracteristique_principal_show", methods={"GET"})
     */
    public function show(CaracteristiquePrincipal $caracteristiquePrincipal): Response
    {
        return $this->render('caracteristique_principal/show.html.twig', [
            'caracteristique_principal' => $caracteristiquePrincipal,
        ]);
    }

    /**
     * @Route("/edit/caracteristique/principal/{id}", name="caracteristique_principal_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CaracteristiquePrincipal $caracteristiquePrincipal): Response
    {
        $form = $this->createForm(CaracteristiquePrincipalType::class, $caracteristiquePrincipal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('caracteristique_principal_index', [
                'id' => $caracteristiquePrincipal->getId(),
            ]);
        }

        return $this->render('caracteristique_principal/edit.html.twig', [
            'caracteristique_principal' => $caracteristiquePrincipal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/suppression/caracteristique/principal/{id}", name="caracteristique_principal_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CaracteristiquePrincipal $caracteristiquePrincipal): Response
    {
        if ($this->isCsrfTokenValid('delete'.$caracteristiquePrincipal->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($caracteristiquePrincipal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('caracteristique_principal_index');
    }
}
