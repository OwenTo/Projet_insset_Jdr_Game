<?php

namespace App\Controller;

use App\Entity\ClassePersonnage;
use App\Form\ClassePersonnageType;
use App\Repository\ClassePersonnageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ClassePersonnageController extends AbstractController
{
    /**
     * @Route("/liste/classe/personnage", name="classe_personnage_index", methods={"GET"})
     */
    public function index(ClassePersonnageRepository $classePersonnageRepository): Response
    {
        return $this->render('classe_personnage/index.html.twig', [
            'classe_personnages' => $classePersonnageRepository->findAll(),
        ]);
    }

    /**
     * @Route("/create/classe/personnage", name="classe_personnage_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $classePersonnage = new ClassePersonnage();
        $form = $this->createForm(ClassePersonnageType::class, $classePersonnage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($classePersonnage);
            $entityManager->flush();

            return $this->redirectToRoute('classe_personnage_index');
        }

        return $this->render('classe_personnage/new.html.twig', [
            'classe_personnage' => $classePersonnage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/detail/classe/personnage/{id}", name="classe_personnage_show", methods={"GET"})
     */
    public function show(ClassePersonnage $classePersonnage): Response
    {
        return $this->render('classe_personnage/show.html.twig', [
            'classe_personnage' => $classePersonnage,
        ]);
    }

    /**
     * @Route("/edit/classe/personnage/{id}", name="classe_personnage_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ClassePersonnage $classePersonnage): Response
    {
        $form = $this->createForm(ClassePersonnageType::class, $classePersonnage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('classe_personnage_index', [
                'id' => $classePersonnage->getId(),
            ]);
        }

        return $this->render('classe_personnage/edit.html.twig', [
            'classe_personnage' => $classePersonnage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/suppression/classe/personnage/{id}", name="classe_personnage_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ClassePersonnage $classePersonnage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$classePersonnage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($classePersonnage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('classe_personnage_index');
    }
}
