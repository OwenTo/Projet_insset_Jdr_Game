<?php

namespace App\Controller;

use App\Entity\Armure;
use App\Form\ArmureType;
use App\Repository\ArmureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ArmureController extends AbstractController
{
    /**
     * @Route("/liste/armure", name="armure_index", methods={"GET"})
     */
    public function index(ArmureRepository $armureRepository): Response
    {
        return $this->render('armure/index.html.twig', ['armures' => $armureRepository->findAll()]);
    }

    /**
     * @Route("/create/armure", name="armure_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $armure = new Armure();
        $form = $this->createForm(ArmureType::class, $armure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($armure);
            $entityManager->flush();

            return $this->redirectToRoute('armure_index');
        }

        return $this->render('armure/new.html.twig', [
            'armure' => $armure,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/detail/armure/{id}", name="armure_show", methods={"GET"})
     */
    public function show(Armure $armure): Response
    {
        return $this->render('armure/show.html.twig', ['armure' => $armure]);
    }

    /**
     * @Route("/edit/{id}", name="armure_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Armure $armure): Response
    {
        $form = $this->createForm(ArmureType::class, $armure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('armure_index', ['id' => $armure->getId()]);
        }

        return $this->render('armure/edit.html.twig', [
            'armure' => $armure,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/supression/{id}", name="armure_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Armure $armure): Response
    {
        if ($this->isCsrfTokenValid('delete'.$armure->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($armure);
            $entityManager->flush();
        }

        return $this->redirectToRoute('armure_index');
    }
}
