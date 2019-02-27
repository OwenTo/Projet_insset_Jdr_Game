<?php
/**
 * Created by PhpStorm.
 * User: figof
 * Date: 27/02/2019
 * Time: 10:56
 */

namespace App\Controller;

use App\Entity\Compagnon;
use App\Entity\Personnage;
use App\Form\CompagnonType;
use App\Form\PersonnageCompagnonType;
use App\Repository\CompagnonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class CompagnonLinkPersonnageController extends AbstractController
{

    /**
     * @Route("/liste/compagnon/link/personage/{idPersonnage}", name="compagnon_index_link", methods={"GET"})
     */
    public function index(CompagnonRepository $compagnonRepository ,Personnage $idPersonnage): Response
    {
        $personnage=$this->searchPersonnageAction($idPersonnage);


        return $this->render('compagnon_link_personnage/index.html.twig', [
            'personnage'=>$personnage,
            'compagnons' => $personnage->getCollCompagnons(),
        ]);
    }



    /**
     * @Route("/add/link/compagnon/personnage/{idPersonnage}", name="compagnon_link_personnage", methods={"GET","POST"})
     */
    public function linkPersonnageCompagnon(Request $request,Personnage $idPersonnage): Response
    {
        $personnage=$this->searchPersonnageAction($idPersonnage);

        $form = $this->createForm(PersonnageCompagnonType::class, $personnage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($personnage);
            $entityManager->flush();

            return $this->redirectToRoute('compagnon_index_link',array('idPersonnage'=>$personnage->getId()));
        }

        return $this->render('compagnon_link_personnage/new.html.twig', [
            'personnage' => $personnage,
            'form' => $form->createView(),
        ]);
    }


    private function searchPersonnageAction(Personnage $personnage)
    {
        $repositoryPersonnage = $this->getDoctrine()->getRepository('App:Personnage');
        //on récupère l'id de la siuation
        // on recuper les info d'une situation precise
        $infoPersonnage = $repositoryPersonnage->find($personnage);

        return $infoPersonnage;
    }



    /**
     * @Route("/supprimer/compagnon/{id}/link/personnage/{idPersonnage}", name="compagnon_delete_link")
     */
    public function delete(Request $request, Compagnon $compagnon ,Personnage $idPersonnage): Response
    {
        $personnage =$this->searchPersonnageAction($idPersonnage);
        $entityManager = $this->getDoctrine()->getManager();
            $personnage->removeCollCompagnon($compagnon);
            $entityManager->flush();

//
        return $this->redirectToRoute('compagnon_index_link',array('idPersonnage'=>$personnage->getId()));
    }


}