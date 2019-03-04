<?php

namespace App\Controller;

use App\Entity\ChoixPersonnage;
use App\Entity\Invitation;
use App\Entity\Partie;
use App\Entity\User;
use App\Form\ChoixPersonnageType;
use App\Repository\ChoixPersonnageRepository;
use App\Repository\InvitationRepository;
use App\Repository\PartieRepository;
use App\Repository\PersonnageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/choix/personnage")
 */
class ChoixPersonnageController extends AbstractController
{
    /**
     * @Route("/liste", name="choix_personnage_index", methods={"GET"})
     * @param ChoixPersonnageRepository $choixPersonnageRepository
     * @return Response
     */
    public function index(ChoixPersonnageRepository $choixPersonnageRepository): Response
    {
        return $this->render('choix_personnage/index.html.twig', [
            'choix_personnages' => $choixPersonnageRepository->findAll(),
        ]);
    }

    /**
     * @Route("/invitation/{idInvitation}/personnage/{idUser}/partie/{idPartie}", name="choix_personnage_new", methods={"GET","POST"})
     * @param Request $request
     * @param User $idUser
     * @param Partie $idPartie
     * @param Invitation $idInvitation
     * @return Response
     */
    public function new(Request $request, User $idUser, Partie $idPartie, Invitation $idInvitation, PersonnageRepository $personnageRepository, InvitationRepository $invitationRepository): Response
    {
        $partieSearch = $invitationRepository->findByPlayer($idUser);
        if (count($partieSearch) != 0) {
            if ($partieSearch[0]->getStatus() == "En attente") {
                $invitation = $this->searchInvitationAction($idInvitation);
                $choixPersonnage = new ChoixPersonnage();
                $partie = $this->searchPartieAction($idPartie);
                $utilisateur = $this->searchUserAction($idUser);
                $personnages = $utilisateur->getPersonnages();

                if (isset($_POST['sendPersonnageChoix'])) {
                    $entityManager = $this->getDoctrine()->getManager();

                    $choixPersonnage->setPartie($partie);
                    $personnageChoix = $personnageRepository->find($_POST['idPersonnage']);
                    $choixPersonnage->setPersonnage($personnageChoix);
                    $entityManager->persist($choixPersonnage);

                    $invitation->setStatus('accepter');

                    $entityManager->persist($invitation);


                    $entityManager->flush();
//
//                    return $this->redirectToRoute('choix_personnage_index');


                    return $this->redirectToRoute('partie_show',['id'=>$partie->getId()]);
                }
            }
        }

        /*$form = $this->createForm(ChoixPersonnageType::class, $choixPersonnage ,array('personnages'=>$personnages));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();


            $choixPersonnage->setPartie($partie);
            $entityManager->persist($choixPersonnage);

            $invitation->setStatus('accepter');

            $entityManager->persist($invitation);


            $entityManager->flush();


//            return $this->redirectToRoute('choix_personnage_index');
        }*/

        return $this->render('choix_personnage/new.html.twig', [
            'choix_personnage' => $choixPersonnage,
            'personnages' => $personnages,
            // 'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/detail/{id}", name="choix_personnage_show", methods={"GET"})
     */
    public function show(ChoixPersonnage $choixPersonnage): Response
    {
        return $this->render('choix_personnage/show.html.twig', [
            'choix_personnage' => $choixPersonnage,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="choix_personnage_edit", methods={"GET","POST"})
     * @param Request $request
     * @param ChoixPersonnage $choixPersonnage
     * @return Response
     */
    public function edit(Request $request, ChoixPersonnage $choixPersonnage): Response
    {
        $form = $this->createForm(ChoixPersonnageType::class, $choixPersonnage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('choix_personnage_index', [
                'id' => $choixPersonnage->getId(),
            ]);
        }

        return $this->render('choix_personnage/edit.html.twig', [
            'choix_personnage' => $choixPersonnage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/supprimer/{id}", name="choix_personnage_delete", methods={"DELETE"})
     * @param Request $request
     * @param ChoixPersonnage $choixPersonnage
     * @return Response
     */
    public function delete(Request $request, ChoixPersonnage $choixPersonnage): Response
    {
        if ($this->isCsrfTokenValid('delete' . $choixPersonnage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($choixPersonnage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('choix_personnage_index');
    }


    private function searchUserAction(User $user)
    {
        $repositoryUser = $this->getDoctrine()->getRepository('App:User');
        //on récupère l'id de la siuation
        // on recuper les info d'une situation precise
        $infoUser = $repositoryUser->find($user);

        return $infoUser;
    }


    private function searchPartieAction(Partie $partie): Partie
    {
        $repositoryPartie = $this->getDoctrine()->getRepository('App:Partie');
        //on récupère l'id de la siuation
        // on recuper les info d'une situation precise
        $infoPartie = $repositoryPartie->find($partie);

        return $infoPartie;
    }


    private function searchInvitationAction(Invitation $invitation)
    {
        $repositoryInvitation = $this->getDoctrine()->getRepository('App:Invitation');
        //on récupère l'id de la siuation
        // on recuper les info d'une situation precise
        $infoInvitation = $repositoryInvitation->find($invitation);

        return $infoInvitation;
    }
}
