<?php

namespace App\Controller;

use App\Entity\TypeCategorie;
use App\Form\TypeCategorieType;
use App\Repository\TypeCategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class TypeCategorieController extends AbstractController
{
    /**
     * @Route("/liste/type/categorie", name="type_categorie_index", methods={"GET"})
     */
    public function index(TypeCategorieRepository $typeCategorieRepository): Response
    {
        return $this->render('type_categorie/index.html.twig', ['type_categories' => $typeCategorieRepository->findAll()]);
    }

    /**
     * @Route("/create/type/categorie", name="type_categorie_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $typeCategorie = new TypeCategorie();
        $form = $this->createForm(TypeCategorieType::class, $typeCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typeCategorie);
            $entityManager->flush();

            return $this->redirectToRoute('type_categorie_index');
        }

        return $this->render('type_categorie/new.html.twig', [
            'type_categorie' => $typeCategorie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/detail/type/categorie/{id}", name="type_categorie_show", methods={"GET"})
     */
    public function show(TypeCategorie $typeCategorie): Response
    {
        return $this->render('type_categorie/show.html.twig', ['type_categorie' => $typeCategorie]);
    }

    /**
     * @Route("/edit/type/categorie/{id}", name="type_categorie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TypeCategorie $typeCategorie): Response
    {
        $form = $this->createForm(TypeCategorieType::class, $typeCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('type_categorie_index', ['id' => $typeCategorie->getId()]);
        }

        return $this->render('type_categorie/edit.html.twig', [
            'type_categorie' => $typeCategorie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/suppression/type/categorie/{id}", name="type_categorie_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TypeCategorie $typeCategorie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeCategorie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typeCategorie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('type_categorie_index');
    }
}
