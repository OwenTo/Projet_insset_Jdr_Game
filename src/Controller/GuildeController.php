<?php

namespace App\Controller;

use App\Entity\Guilde;
use App\Form\GuildeType;
use App\Repository\GuildeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/guilde")
 */
class GuildeController extends AbstractController
{
    /**
     * @Route("/", name="guilde_index", methods={"GET"})
     */
    public function index(GuildeRepository $guildeRepository): Response
    {
        return $this->render('guilde/index.html.twig', [
            'guildes' => $guildeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="guilde_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $guilde = new Guilde();
        $form = $this->createForm(GuildeType::class, $guilde);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($guilde);
            $entityManager->flush();

            return $this->redirectToRoute('guilde_index');
        }

        return $this->render('guilde/new.html.twig', [
            'guilde' => $guilde,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="guilde_show", methods={"GET"})
     */
    public function show(Guilde $guilde): Response
    {
        return $this->render('guilde/show.html.twig', [
            'guilde' => $guilde,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="guilde_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Guilde $guilde): Response
    {
        $form = $this->createForm(GuildeType::class, $guilde);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('guilde_index', [
                'id' => $guilde->getId(),
            ]);
        }

        return $this->render('guilde/edit.html.twig', [
            'guilde' => $guilde,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="guilde_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Guilde $guilde): Response
    {
        if ($this->isCsrfTokenValid('delete'.$guilde->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($guilde);
            $entityManager->flush();
        }

        return $this->redirectToRoute('guilde_index');
    }
}
