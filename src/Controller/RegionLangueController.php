<?php

namespace App\Controller;

use App\Entity\RegionLangue;
use App\Form\RegionLangueType;
use App\Repository\RegionLangueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class RegionLangueController extends AbstractController
{
    /**
     * @Route("/liste/region/langue", name="region_langue_index", methods={"GET"})
     */
    public function index(RegionLangueRepository $regionLangueRepository): Response
    {
        return $this->render('region_langue/index.html.twig', [
            'region_langues' => $regionLangueRepository->findAll(),
        ]);
    }

    /**
     * @Route("/create/region/langue", name="region_langue_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $regionLangue = new RegionLangue();
        $form = $this->createForm(RegionLangueType::class, $regionLangue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($regionLangue);
            $entityManager->flush();

            return $this->redirectToRoute('region_langue_index');
        }

        return $this->render('region_langue/new.html.twig', [
            'region_langue' => $regionLangue,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/detail/region/langue/{id}", name="region_langue_show", methods={"GET"})
     */
    public function show(RegionLangue $regionLangue): Response
    {
        return $this->render('region_langue/show.html.twig', [
            'region_langue' => $regionLangue,
        ]);
    }

    /**
     * @Route("/edit/region/langue/{id}", name="region_langue_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, RegionLangue $regionLangue): Response
    {
        $form = $this->createForm(RegionLangueType::class, $regionLangue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('region_langue_index', [
                'id' => $regionLangue->getId(),
            ]);
        }

        return $this->render('region_langue/edit.html.twig', [
            'region_langue' => $regionLangue,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/suppression/region/langue/{id}", name="region_langue_delete", methods={"DELETE"})
     */
    public function delete(Request $request, RegionLangue $regionLangue): Response
    {
        if ($this->isCsrfTokenValid('delete'.$regionLangue->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($regionLangue);
            $entityManager->flush();
        }

        return $this->redirectToRoute('region_langue_index');
    }
}
