<?php

namespace App\Controller;

use App\Entity\Personnage;
use App\Entity\RangGuilde;
use App\Form\RangGuildeEditType;
use App\Form\RangGuildeType;
use App\Repository\RangGuildeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class RangGuildeController extends AbstractController
{
    /**
     * @Route("/liste/personnage/{idPersonnage}/rang/guilde", name="personnage_rang_guilde_index", methods={"GET"})
     * @param RangGuildeRepository $rangGuildeRepository
     * @param Personnage $idPersonnage
     * @return Response
     */
    public function index(RangGuildeRepository $rangGuildeRepository,Personnage $idPersonnage): Response
    {

        $personnage=$this->searchPersonnageAction($idPersonnage);

        return $this->render('rang_guilde/index.html.twig', [
//            'rang_guildes' => $rangGuildeRepository->findAll(),
            'rang_guildes' => $personnage->getCollRangGuilds(),
            'personnage'=>$personnage

        ]);
    }

    /**
     * @Route("/create/rang/guilde/{idPersonnage}", name="rang_guilde_new", methods={"GET","POST"})
     * @Route("add/rang/guilde/{idPersonnage}", name="rang_guilde_new_personnage", methods={"GET","POST"})
     * @param Request $request
     * @param Personnage $idPersonnage
     * @return Response
     */
    public function new(Request $request,Personnage $idPersonnage): Response
    {
        $personnage=$this->searchPersonnageAction($idPersonnage);


        $rangGuilde = new RangGuilde();
        $form = $this->createForm(RangGuildeType::class, $rangGuilde);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $personnage->addCollRangGuild($rangGuilde);
            $entityManager->persist($rangGuilde);
            $entityManager->persist($personnage);
            $entityManager->flush();

            return $this->redirectToRoute('personnage_rang_guilde_index',array('idPersonnage'=>$personnage->getId()));
        }

        return $this->render('rang_guilde/new.html.twig', [
            'rang_guilde' => $rangGuilde,
            'personnage'=>$personnage,

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
        $form = $this->createForm(RangGuildeEditType::class, $rangGuilde);
        $form->handleRequest($request);

        $personnage=$rangGuilde->getPersonnage();
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('personnage_rang_guilde_index', ['idPersonnage'=>$personnage->getId(),
//                'id' => $rangGuilde->getId(),
            ]);
        }

        return $this->render('rang_guilde/edit.html.twig', [
            'rang_guilde' => $rangGuilde,
            'personnage'=>$personnage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/suppression/rang/guilde/{id}", name="rang_guilde_delete", methods={"DELETE"})
     * @Route("/supprimer/rang/guilde/{id}", name="rang_guilde_delete", methods={"DELETE"})
     */
    public function delete(Request $request, RangGuilde $rangGuilde): Response
    {
        $personnage=$rangGuilde->getPersonnage();


        if ($this->isCsrfTokenValid('delete'.$rangGuilde->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($rangGuilde);
            $entityManager->flush();
        }

        return $this->redirectToRoute('personnage_rang_guilde_index',array('idPersonnage'=>$personnage->getId()));
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
