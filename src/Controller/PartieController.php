<?php

namespace App\Controller;

use App\Entity\Invitation;
use App\Entity\Partie;
use App\Entity\User;
use App\Form\PartieType;
use App\Notification\ContactNotification;
use App\Repository\PartieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PartieController extends AbstractController
{
    /**
     * @Route("/liste/partie", name="partie_index", methods={"GET"})
     */
    public function index(PartieRepository $partieRepository): Response
    {
        return $this->render('partie/index.html.twig', [
            'parties' => $partieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/liste/mes/partie/{idUser}", name="partie_index_user")
     */
    public function liste(User $idUser): Response
    {
        $user = $this->searchUserAction($idUser);

//var_dump($user);
        return $this->render('partie/mes_parties_liste.html.twig', [
            'parties' => $user->getParties(), 'user' => $user
//            'parties' => $partieRepository->findAll(),
        ]);
    }


    /**
     * @Route("/create/partie/{idUser}", name="partie_new", methods={"GET","POST"})
     * @Route("/add/partie/{idUser}", name="partie_new_user", methods={"GET","POST"})
     */
    public function new(Request $request, User $idUser, ContactNotification $invitationMail): Response
    {
        $user = $this->searchUserAction($idUser);
        $partie = new Partie();
        $form = $this->createForm(PartieType::class, $partie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $partie->setUtilisateur($user);

            $joueurs = $partie->getJoueurs();

            $entityManager->persist($partie);


            $entityManager->flush();


            foreach ($joueurs as $joueur) {
                $invitation = new Invitation();
                $invitation->setPartie($partie);
                $invitation->setPlayer($joueur);
                $invitation->setStatus("En attente");

                $entityManager->persist($invitation);
                $entityManager->flush();

                $invitationMail->notifyInvitationPartie($invitation);


            }

            $entityManager->flush();

            $message = " la partie est crée et les mails d'invitation on été envoyé";
            $this->addFlash('success', $message);
            return $this->redirectToRoute('partie_show', ['id' => $partie->getId()]);
//            return $this->render('home.html.twig');

//            return $this->redirectToRoute('partie_index');
        }

        return $this->render('partie/new.html.twig', [
            'partie' => $partie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/detail/partie/{id}", name="partie_show", methods={"GET"})
     */
    public function show(Partie $partie): Response
    {
        return $this->render('partie/show.html.twig', [
            'partie' => $partie,
        ]);
    }

    /**
     * @Route("/edit/partie/{id}", name="partie_edit", methods={"GET","POST"})
     * @Route("/editer/partie/{id}", name="partie_edit_user", methods={"GET","POST"})
     * @param Request $request
     * @param Partie $partie
     * @param ContactNotification $invitationMail
     * @return Response
     */
    public function edit(Request $request, Partie $partie, ContactNotification $invitationMail): Response
    {
        $form = $this->createForm(PartieType::class, $partie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();


            $this->getDoctrine()->getManager()->flush();

            $joueurs = $partie->getJoueurs();

            $partieInvitations = $partie->getInvitations();


            foreach ($joueurs as $joueur) {

                foreach ($partieInvitations as $partieInvitation) {
                    $joueurDejaInscrit = $partieInvitation->getPlayer();


                    if ($joueur !== $joueurDejaInscrit) {
                        $invitation = new Invitation();
                        $invitation->setPartie($partie);
                        $invitation->setPlayer($joueur);
                        $invitation->setStatus("En attente");

                        $entityManager->persist($invitation);


                        $entityManager->flush();

                        $invitationMail->notifyInvitationPartie($invitation);
                    }
                }

            }


            return $this->redirectToRoute('partie_index', [
                'id' => $partie->getId(),
            ]);
        }

        return $this->render('partie/edit.html.twig', [
            'partie' => $partie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/suppression/partie/{id}", name="partie_delete", methods={"DELETE"})
     * @Route("/supprimer/partie/{id}", name="partie_delete_user", methods={"DELETE"})
     */
    public function delete(Request $request, Partie $partie): Response
    {
        $idUtilisateur = $partie->getUtilisateur()->getId();

        if ($this->isCsrfTokenValid('delete' . $partie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($partie);
            $entityManager->flush();
        }

//        return $this->redirectToRoute('partie_index_user',['idUser'=>$idUtilisateur]);
        return $this->redirectToRoute('partie_index');
    }


    private function searchUserAction(User $user)
    {
        $repositoryUser = $this->getDoctrine()->getRepository('App:User');
        //on récupère l'id de la siuation
        // on recuper les info d'une situation precise
        $infoUser = $repositoryUser->find($user);

        return $infoUser;
    }
}
