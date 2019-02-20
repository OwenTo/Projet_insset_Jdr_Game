<?php

namespace App\Controller;

use App\Entity\CompagnonType;
use App\Form\CompagnonTypeType;
use App\Repository\CompagnonTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CompagnonTypeController extends AbstractController
{
    /**
     * @Route("/liste/compagnon/type", name="compagnon_type_index", methods={"GET"})
     */
    public function index(CompagnonTypeRepository $compagnonTypeRepository): Response
    {
        return $this->render('compagnon_type/index.html.twig', [
            'compagnon_types' => $compagnonTypeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/create/compagnon/type", name="compagnon_type_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $compagnonType = new CompagnonType();
        $form = $this->createForm(CompagnonTypeType::class, $compagnonType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($compagnonType);
            $entityManager->flush();

            return $this->redirectToRoute('compagnon_type_index');
        }

        return $this->render('compagnon_type/new.html.twig', [
            'compagnon_type' => $compagnonType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/detail/compagnon/type/{id}", name="compagnon_type_show", methods={"GET"})
     */
    public function show(CompagnonType $compagnonType): Response
    {
        return $this->render('compagnon_type/show.html.twig', [
            'compagnon_type' => $compagnonType,
        ]);
    }

    /**
     * @Route("/edit/compagnon/type/{id}", name="compagnon_type_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CompagnonType $compagnonType): Response
    {
        $form = $this->createForm(CompagnonTypeType::class, $compagnonType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('compagnon_type_index', [
                'id' => $compagnonType->getId(),
            ]);
        }

        return $this->render('compagnon_type/edit.html.twig', [
            'compagnon_type' => $compagnonType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/suppression/compagnon/type/{id}", name="compagnon_type_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CompagnonType $compagnonType): Response
    {
        if ($this->isCsrfTokenValid('delete'.$compagnonType->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($compagnonType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('compagnon_type_index');
    }




}
