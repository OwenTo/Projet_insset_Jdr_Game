<?php

namespace App\Controller;

use App\Entity\NiveauMetier;
use App\Entity\Personnage;
use App\Entity\User;
use App\Form\NiveauMetier2Type;
use App\Form\NiveauMetierType;
use App\Repository\NiveauMetierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class NiveauMetierController extends AbstractController
{
    /**
     * @Route("/liste/niveau/metier", name="niveau_metier_index", methods={"GET"})
     */
    public function index(NiveauMetierRepository $niveauMetierRepository): Response
    {
        return $this->render('niveau_metier/index.html.twig', [
            'niveau_metiers' => $niveauMetierRepository->findAll(),
        ]);
    }

    /**
     * @Route("/create/niveau/metier", name="niveau_metier_new", methods={"GET","POST"})
     * @Route("/add/personnage/niveau/metier/{idPersonnage}",name="personnage_niveau_metier", methods={"GET","POST"})

     */
    public function new(Request $request ,Personnage $idPersonnage): Response
    {
        $personnage=$this->searchPersonnageAction($idPersonnage);

        $niveauMetier = new NiveauMetier();
        $form = $this->createForm(NiveauMetierType::class, $niveauMetier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();



            $niveauMetier->setNiveauMetier(1);
            $niveauMetier->setPersonnage($personnage);

            $entityManager->persist($niveauMetier);



            $entityManager->persist($personnage);

            $entityManager->flush();

            return $this->redirectToRoute('niveau_metier_index');
        }

        return $this->render('niveau_metier/new.html.twig', [
            'niveau_metier' => $niveauMetier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/detail/niveau/metier/{id}", name="niveau_metier_show", methods={"GET"})
     */
    public function show(NiveauMetier $niveauMetier): Response
    {
        return $this->render('niveau_metier/show.html.twig', [
            'niveau_metier' => $niveauMetier,
        ]);
    }

    /**
     * @Route("/edit/niveau/metier/{id}", name="niveau_metier_edit", methods={"GET","POST"})
     * @Route("/editer/user/niveau/metier/{id}",name="personnage_niveau_metier_editer", methods={"GET","POST"})

     */
    public function edit(Request $request, NiveauMetier $niveauMetier): Response
    {
        $form = $this->createForm(NiveauMetier2Type::class, $niveauMetier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('niveau_metier_index', [
                'id' => $niveauMetier->getId(),
            ]);
        }

        return $this->render('niveau_metier/edit.html.twig', [
            'niveau_metier' => $niveauMetier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/suppression/personnage/niveau/metier/{id}", name="niveau_metier_delete", methods={"DELETE"})
     * @Route("/delete/Personnage/niveau/metie/{id}",name="user_niveau_metier_supression",  methods={"DELETE"})

     */
    public function delete(Request $request, NiveauMetier $niveauMetier): Response
    {
        if ($this->isCsrfTokenValid('delete'.$niveauMetier->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($niveauMetier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('niveau_metier_index');
    }

    private function searchPersonnageAction(Personnage $personnage)
    {
        $repositoryPersonnage = $this->getDoctrine()->getRepository('App:Personnage');
        //on récupère l'id de la siuation
        // on recuper les info d'une situation precise
        $infoPersonnage = $repositoryPersonnage->find($personnage);

        return $infoPersonnage;
    }
}
