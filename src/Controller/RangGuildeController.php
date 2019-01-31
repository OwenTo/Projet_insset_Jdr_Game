<?php

namespace App\Controller;

use App\Entity\Personnage;
use App\Entity\RangGuilde;
use App\Form\RangGuildeType;
use App\Repository\RangGuildeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class RangGuildeController extends AbstractController
{
    /**
     * @Route("/liste/rang/guilde", name="rang_guilde_index", methods={"GET"})
     */
    public function index(RangGuildeRepository $rangGuildeRepository): Response
    {
        return $this->render('rang_guilde/index.html.twig', [
            'rang_guildes' => $rangGuildeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/create/rang/guilde/{idPersonnage}", name="rang_guilde_new", methods={"GET","POST"})
     * @Route("add/rang/guilde/{idPersonnage}", name="rang_guilde_new_personnage", methods={"GET","POST"})
     */
    public function new(Request $request,Personnage $idPersonnage): Response
    {
        $personnage=$this->getDoctrine()->getRepository('Personnage')->find($idPersonnage);


        $rangGuilde = new RangGuilde();
        $form = $this->createForm(RangGuildeType::class, $rangGuilde);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $personnage->addCollRangGuilds($rangGuilde);
            $entityManager->persist($rangGuilde);
            $entityManager->persist($personnage);
            $entityManager->flush();

            return $this->redirectToRoute('rang_guilde_index');
        }

        return $this->render('rang_guilde/new.html.twig', [
            'rang_guilde' => $rangGuilde,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/detail/rang/guilde/{id}", name="rang_guilde_show", methods={"GET"})
     */
    public function show(RangGuilde $rangGuilde): Response
    {
        return $this->render('rang_guilde/show.html.twig', [
            'rang_guilde' => $rangGuilde,
        ]);
    }

    /**
     * @Route("/edit/rang/guilde/{id}", name="rang_guilde_edit", methods={"GET","POST"})
     * @Route("/editer/rang/guilde/{id}", name="rang_guilde_edit_personnage", methods={"GET","POST"})
     */
    public function edit(Request $request, RangGuilde $rangGuilde): Response
    {
        $form = $this->createForm(RangGuildeType::class, $rangGuilde);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('rang_guilde_index', [
                'id' => $rangGuilde->getId(),
            ]);
        }

        return $this->render('rang_guilde/edit.html.twig', [
            'rang_guilde' => $rangGuilde,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/suppression/rang/guilde/{id}", name="rang_guilde_delete", methods={"DELETE"})
     * @Route("/supprimer/rang/guilde/{id}", name="rang_guilde_delete", methods={"DELETE"})
     */
    public function delete(Request $request, RangGuilde $rangGuilde): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rangGuilde->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($rangGuilde);
            $entityManager->flush();
        }

        return $this->redirectToRoute('rang_guilde_index');
    }
}
