<?php

namespace App\Controller;

use App\Entity\TypeDes;
use App\Form\TypeDesType;
use App\Repository\TypeDesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class TypeDesController extends AbstractController
{
    /**
     * @Route("/liste/type/des", name="type_des_index", methods={"GET"})
     */
    public function index(TypeDesRepository $typeDesRepository): Response
    {
        return $this->render('type_des/index.html.twig', ['type_des' => $typeDesRepository->findAll()]);
    }

    /**
     * @Route("/create/type/des", name="type_des_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $typeDe = new TypeDes();
        $form = $this->createForm(TypeDesType::class, $typeDe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typeDe);
            $entityManager->flush();

            return $this->redirectToRoute('type_des_index');
        }

        return $this->render('type_des/new.html.twig', [
            'type_de' => $typeDe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{detail/type/des/{id}", name="type_des_show", methods={"GET"})
     */
    public function show(TypeDes $typeDe): Response
    {
        return $this->render('type_des/show.html.twig', ['type_de' => $typeDe]);
    }

    /**
     * @Route("/edit/type/des/{id}", name="type_des_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TypeDes $typeDe): Response
    {
        $form = $this->createForm(TypeDesType::class, $typeDe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('type_des_index', ['id' => $typeDe->getId()]);
        }

        return $this->render('type_des/edit.html.twig', [
            'type_de' => $typeDe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/suppression/type/des/{id}", name="type_des_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TypeDes $typeDe): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeDe->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typeDe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('type_des_index');
    }
}
