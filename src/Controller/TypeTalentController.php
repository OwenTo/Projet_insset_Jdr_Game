<?php

namespace App\Controller;

use App\Entity\TypeTalent;
use App\Form\TypeTalentType;
use App\Repository\TypeTalentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class TypeTalentController extends AbstractController
{
    /**
     * @Route("/liste/type/talent", name="type_talent_index", methods={"GET"})
     */
    public function index(TypeTalentRepository $typeTalentRepository): Response
    {
        return $this->render('type_talent/index.html.twig', ['type_talents' => $typeTalentRepository->findAll()]);
    }

    /**
     * @Route("/create/type/talent", name="type_talent_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $typeTalent = new TypeTalent();
        $form = $this->createForm(TypeTalentType::class, $typeTalent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typeTalent);
            $entityManager->flush();

            return $this->redirectToRoute('type_talent_index');
        }

        return $this->render('type_talent/new.html.twig', [
            'type_talent' => $typeTalent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_talent_show", methods={"GET"})
     */
    public function show(TypeTalent $typeTalent): Response
    {
        return $this->render('type_talent/show.html.twig', ['type_talent' => $typeTalent]);
    }

    /**
     * @Route("/edit/type/talent/{id}", name="type_talent_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TypeTalent $typeTalent): Response
    {
        $form = $this->createForm(TypeTalentType::class, $typeTalent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('type_talent_index', ['id' => $typeTalent->getId()]);
        }

        return $this->render('type_talent/edit.html.twig', [
            'type_talent' => $typeTalent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/supression/type/talent/{id}", name="type_talent_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TypeTalent $typeTalent): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeTalent->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typeTalent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('type_talent_index');
    }
}
