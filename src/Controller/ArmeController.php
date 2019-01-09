<?php

namespace App\Controller;

use App\Entity\Arme;
use App\Form\Arme1Type;
use App\Repository\ArmeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ArmeController extends AbstractController
{
    /**
     * @Route("/liste/arme", name="arme_index", methods={"GET"})
     */
    public function index(ArmeRepository $armeRepository): Response
    {
        return $this->render('arme/index.html.twig', ['armes' => $armeRepository->findAll()]);
    }

    /**
     * @Route("/create/arme", name="arme_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $arme = new Arme();
        $form = $this->createForm(Arme1Type::class, $arme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($arme);
            $entityManager->flush();

            return $this->redirectToRoute('arme_index');
        }

        return $this->render('arme/new.html.twig', [
            'arme' => $arme,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/detail/arme/{id}", name="arme_show", methods={"GET"})
     */
    public function show(Arme $arme): Response
    {
        return $this->render('arme/show.html.twig', ['arme' => $arme]);
    }

    /**
     * @Route("/edit/arme{id}", name="arme_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Arme $arme): Response
    {
        $form = $this->createForm(Arme1Type::class, $arme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('arme_index', ['id' => $arme->getId()]);
        }

        return $this->render('arme/edit.html.twig', [
            'arme' => $arme,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{suppression/arme/id}", name="arme_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Arme $arme): Response
    {
        if ($this->isCsrfTokenValid('delete'.$arme->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($arme);
            $entityManager->flush();
        }

        return $this->redirectToRoute('arme_index');
    }
}
