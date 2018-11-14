<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/security", name="security")
     */
    public function index()
    {
        return $this->render('security/index.html.twig', [
            'controller_name' => 'SecurityController',
        ]);
    }


    /**
     * @Route("/inscription", name="registration")
     * @Route("/security/edit/{id}",name="edit_registration")
     */
    public function registration(User $user = null, Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {


        if (!$user) {
            $user = new User();
        }
        $form = $this->createForm(RegistrationType::class, $user);


        $form->handleRequest($request);
        ///on génère le HTML du formulaire crée
        ///
        $formView = $form->createView();

        // si génére le HTML du formulaire crée
        if ($form->isSubmitted() && $form->isValid()) {

                if (!empty($user->getPassword())) {
                    $hash = $encoder->encodePassword($user, $user->getPassword());
                    $user->setPassword($hash);

                }
                $manager->persist($user);
                $manager->flush();
                return $this->redirectToRoute('security_login');
            }

/// editMQode permet  a la page (bouton)
///  s'il y s'agit d'une promiére inscription ou d'une edition
        return $this->render('security/registration.html.twig',
            [
                'form' => $formView,
                'editMode' => $user->getId() !== null,

            ]);
    }

    /**
     * @Route("/connexion" ,name="security_login")
     */
    public function login()
    {
        return $this->render('security/login.html.twig');
    }


    /**
     * @Route("/deconnexion",name="security_logout")
     */
    public function logout()
    {

    }


    /**
     * @Route("/Security/Information/utilisateur{id}", name="infoUser")
     */
    public function listFolderByUserAction(User $user,ObjectManager $manager)
    {
        $infoUser = $this->searchUserForFolderAction($user);


        return $this->render('security/infoUser.html.twig', array('user' => $infoUser));

    }

    private function searchUserForFolderAction(User $user)
    {
        $repositoryUser = $this->getDoctrine()->getRepository('App:User');
        //on récupère l'id de la siuation
        // on recuper les info d'une situation precise
        $infoUser = $repositoryUser->find($user);

        return $infoUser;
    }
}
