<?php

namespace App\Controller;

use App\Entity\Magie;
use App\Form\MagieType;
use App\Repository\MagieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/magie")
 */
class MagieController extends AbstractController
{
    /**
     * @Route("/", name="magie_index", methods={"GET"})
     */
    public function index(MagieRepository $magieRepository): Response
    {
        return $this->render('magie/index.html.twig', ['magies' => $magieRepository->findAll()]);
    }

    /**
     * @Route("/new", name="magie_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $magie = new Magie();
        $form = $this->createForm(MagieType::class, $magie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($magie);
            $entityManager->flush();

            return $this->redirectToRoute('magie_index');
        }

        return $this->render('magie/new.html.twig', [
            'magie' => $magie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="magie_show", methods={"GET"})
     */
    public function show(Magie $magie): Response
    {
        return $this->render('magie/show.html.twig', ['magie' => $magie]);
    }

    /**
     * @Route("/{id}/edit", name="magie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Magie $magie): Response
    {
        $form = $this->createForm(MagieType::class, $magie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('magie_index', ['id' => $magie->getId()]);
        }

        return $this->render('magie/edit.html.twig', [
            'magie' => $magie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="magie_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Magie $magie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$magie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($magie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('magie_index');
    }
}
