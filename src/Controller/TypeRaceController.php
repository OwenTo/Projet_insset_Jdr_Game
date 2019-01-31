<?php

namespace App\Controller;

use App\Entity\TypeRace;
use App\Form\TypeRaceType;
use App\Repository\TypeRaceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class TypeRaceController extends AbstractController
{
    /**
     * @Route("/liste/type/race", name="type_race_index", methods={"GET"})
     */
    public function index(TypeRaceRepository $typeRaceRepository): Response
    {
        return $this->render('type_race/index.html.twig', [
            'type_races' => $typeRaceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/create/type/race", name="type_race_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $typeRace = new TypeRace();
        $form = $this->createForm(TypeRaceType::class, $typeRace);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typeRace);
            $entityManager->flush();

            return $this->redirectToRoute('type_race_index');
        }

        return $this->render('type_race/new.html.twig', [
            'type_race' => $typeRace,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/detail/type/race/{id}", name="type_race_show", methods={"GET"})
     */
    public function show(TypeRace $typeRace): Response
    {
        return $this->render('type_race/show.html.twig', [
            'type_race' => $typeRace,
        ]);
    }

    /**
     * @Route("/edit/type/race/{id}", name="type_race_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TypeRace $typeRace): Response
    {
        $form = $this->createForm(TypeRaceType::class, $typeRace);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('type_race_index', [
                'id' => $typeRace->getId(),
            ]);
        }

        return $this->render('type_race/edit.html.twig', [
            'type_race' => $typeRace,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/suppression/type/race/{id}", name="type_race_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TypeRace $typeRace): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeRace->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typeRace);
            $entityManager->flush();
        }

        return $this->redirectToRoute('type_race_index');
    }
}
