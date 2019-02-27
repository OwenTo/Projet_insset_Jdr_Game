<?php

namespace App\Controller;

use App\Entity\LangueType;
use App\Form\LangueTypeType;
use App\Repository\LangueTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class LangueTypeController extends AbstractController
{
    /**
     * @Route("/liste/langue/type", name="langue_type_index", methods={"GET"})
     */
    public function index(LangueTypeRepository $langueTypeRepository): Response
    {
        return $this->render('langue_type/index.html.twig', [
            'langue_types' => $langueTypeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/create/langue/type", name="langue_type_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $langueType = new LangueType();
        $form = $this->createForm(LangueTypeType::class, $langueType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($langueType);
            $entityManager->flush();

            return $this->redirectToRoute('langue_type_index');
        }

        return $this->render('langue_type/new.html.twig', [
            'langue_type' => $langueType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/detail/langue/type/{id}", name="langue_type_show", methods={"GET"})
     */
    public function show(LangueType $langueType): Response
    {
        return $this->render('langue_type/show.html.twig', [
            'langue_type' => $langueType,
        ]);
    }

    /**
     * @Route("/edit/langue/type/{id}", name="langue_type_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, LangueType $langueType): Response
    {
        $form = $this->createForm(LangueTypeType::class, $langueType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('langue_type_index', [
                'id' => $langueType->getId(),
            ]);
        }

        return $this->render('langue_type/edit.html.twig', [
            'langue_type' => $langueType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/suppression/langue/type/id}", name="langue_type_delete", methods={"DELETE"})
     */
    public function delete(Request $request, LangueType $langueType): Response
    {
        if ($this->isCsrfTokenValid('delete'.$langueType->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($langueType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('langue_type_index');
    }
}
