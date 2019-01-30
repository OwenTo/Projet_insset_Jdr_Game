<?php

namespace App\Controller;

use App\Entity\Compagnon;
use App\Form\CompagnonType;
use App\Repository\CompagnonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CompagnonController extends AbstractController
{
    /**
     * @Route("/liste/compagnon", name="compagnon_index", methods={"GET"})
     */
    public function index(CompagnonRepository $compagnonRepository): Response
    {
        return $this->render('compagnon/index.html.twig', [
            'compagnons' => $compagnonRepository->findAll(),
        ]);
    }

    /**
     * @Route("/create/compagnon", name="compagnon_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $compagnon = new Compagnon();
        $form = $this->createForm(CompagnonType::class, $compagnon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($compagnon);
            $entityManager->flush();

            return $this->redirectToRoute('compagnon_index');
        }

        return $this->render('compagnon/new.html.twig', [
            'compagnon' => $compagnon,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/detail/compagnon/{id}", name="compagnon_show", methods={"GET"})
     */
    public function show(Compagnon $compagnon): Response
    {
        return $this->render('compagnon/show.html.twig', [
            'compagnon' => $compagnon,
        ]);
    }

    /**
     * @Route("/edit/compagnon/{id}", name="compagnon_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Compagnon $compagnon): Response
    {
        $form = $this->createForm(CompagnonType::class, $compagnon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('compagnon_index', [
                'id' => $compagnon->getId(),
            ]);
        }

        return $this->render('compagnon/edit.html.twig', [
            'compagnon' => $compagnon,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/suppression/compagnon/{id}", name="compagnon_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Compagnon $compagnon): Response
    {
        if ($this->isCsrfTokenValid('delete'.$compagnon->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($compagnon);
            $entityManager->flush();
        }

        return $this->redirectToRoute('compagnon_index');
    }
}
