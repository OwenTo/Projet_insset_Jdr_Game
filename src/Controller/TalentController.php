<?php

namespace App\Controller;

use App\Entity\Talent;
use App\Form\TalentType;
use App\Repository\TalentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class TalentController extends AbstractController
{
    /**
     * @Route("/liste/talent", name="talent_index", methods={"GET"})
     */
    public function index(TalentRepository $talentRepository): Response
    {
        return $this->render('talent/index.html.twig', ['talents' => $talentRepository->findAll()]);
    }

    /**
     * @Route("/create/talent", name="talent_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $talent = new Talent();
        $form = $this->createForm(TalentType::class, $talent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($talent);
            $entityManager->flush();

            return $this->redirectToRoute('talent_index');
        }

        return $this->render('talent/new.html.twig', [
            'talent' => $talent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/detail/talent/{id}", name="talent_show", methods={"GET"})
     */
    public function show(Talent $talent): Response
    {
        return $this->render('talent/show.html.twig', ['talent' => $talent]);
    }

    /**
     * @Route("/edit/talent/{id}", name="talent_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Talent $talent): Response
    {
        $form = $this->createForm(TalentType::class, $talent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('talent_index', ['id' => $talent->getId()]);
        }

        return $this->render('talent/edit.html.twig', [
            'talent' => $talent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/supression/talent/{id}", name="talent_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Talent $talent): Response
    {
        if ($this->isCsrfTokenValid('delete'.$talent->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($talent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('talent_index');
    }
}
