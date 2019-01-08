<?php

namespace App\Controller;

use App\Entity\TypeMagie;
use App\Form\TypeMagieType;
use App\Repository\TypeMagieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/type/magie")
 */
class TypeMagieController extends AbstractController
{
    /**
     * @Route("/", name="type_magie_index", methods={"GET"})
     */
    public function index(TypeMagieRepository $typeMagieRepository): Response
    {
        return $this->render('type_magie/index.html.twig', ['type_magies' => $typeMagieRepository->findAll()]);
    }

    /**
     * @Route("/new", name="type_magie_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $typeMagie = new TypeMagie();
        $form = $this->createForm(TypeMagieType::class, $typeMagie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typeMagie);
            $entityManager->flush();

            return $this->redirectToRoute('type_magie_index');
        }

        return $this->render('type_magie/new.html.twig', [
            'type_magie' => $typeMagie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_magie_show", methods={"GET"})
     */
    public function show(TypeMagie $typeMagie): Response
    {
        return $this->render('type_magie/show.html.twig', ['type_magie' => $typeMagie]);
    }

    /**
     * @Route("/{id}/edit", name="type_magie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TypeMagie $typeMagie): Response
    {
        $form = $this->createForm(TypeMagieType::class, $typeMagie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('type_magie_index', ['id' => $typeMagie->getId()]);
        }

        return $this->render('type_magie/edit.html.twig', [
            'type_magie' => $typeMagie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_magie_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TypeMagie $typeMagie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeMagie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typeMagie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('type_magie_index');
    }
}
