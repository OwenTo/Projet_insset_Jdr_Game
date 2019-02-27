<?php

namespace App\Controller;

use App\Entity\TypeGuilde;
use App\Form\TypeGuildeType;
use App\Repository\TypeGuildeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class TypeGuildeController extends AbstractController
{
    /**
     * @Route("/liste/type/guilde", name="type_guilde_index", methods={"GET"})
     */
    public function index(TypeGuildeRepository $typeGuildeRepository): Response
    {
        return $this->render('type_guilde/index.html.twig', [
            'type_guildes' => $typeGuildeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/create/type/guilde", name="type_guilde_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $typeGuilde = new TypeGuilde();
        $form = $this->createForm(TypeGuildeType::class, $typeGuilde);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typeGuilde);
            $entityManager->flush();

            return $this->redirectToRoute('type_guilde_index');
        }

        return $this->render('type_guilde/new.html.twig', [
            'type_guilde' => $typeGuilde,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/detail/type/guilde/{id}", name="type_guilde_show", methods={"GET"})
     */
    public function show(TypeGuilde $typeGuilde): Response
    {
        return $this->render('type_guilde/show.html.twig', [
            'type_guilde' => $typeGuilde,
        ]);
    }

    /**
     * @Route("/edit/type/guilde/{id}", name="type_guilde_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TypeGuilde $typeGuilde): Response
    {
        $form = $this->createForm(TypeGuildeType::class, $typeGuilde);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('type_guilde_index', [
                'id' => $typeGuilde->getId(),
            ]);
        }

        return $this->render('type_guilde/edit.html.twig', [
            'type_guilde' => $typeGuilde,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/suppression/type/guilde/{id}", name="type_guilde_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TypeGuilde $typeGuilde): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeGuilde->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typeGuilde);
            $entityManager->flush();
        }

        return $this->redirectToRoute('type_guilde_index');
    }
}
