<?php

namespace App\Controller;

use App\Entity\Monnaie;
use App\Form\MonnaieType;
use App\Repository\MonnaieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/monnaie")
 */
class MonnaieController extends AbstractController
{
    /**
     * @Route("/", name="monnaie_index", methods={"GET"})
     */
    public function index(MonnaieRepository $monnaieRepository): Response
    {
        return $this->render('monnaie/index.html.twig', ['monnaies' => $monnaieRepository->findAll()]);
    }

    /**
     * @Route("/new", name="monnaie_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $monnaie = new Monnaie();
        $form = $this->createForm(MonnaieType::class, $monnaie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($monnaie);
            $entityManager->flush();

            return $this->redirectToRoute('monnaie_index');
        }

        return $this->render('monnaie/new.html.twig', [
            'monnaie' => $monnaie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="monnaie_show", methods={"GET"})
     */
    public function show(Monnaie $monnaie): Response
    {
        return $this->render('monnaie/show.html.twig', ['monnaie' => $monnaie]);
    }

    /**
     * @Route("/{id}/edit", name="monnaie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Monnaie $monnaie): Response
    {
        $form = $this->createForm(MonnaieType::class, $monnaie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('monnaie_index', ['id' => $monnaie->getId()]);
        }

        return $this->render('monnaie/edit.html.twig', [
            'monnaie' => $monnaie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="monnaie_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Monnaie $monnaie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$monnaie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($monnaie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('monnaie_index');
    }
}
