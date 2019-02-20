<?php

namespace App\Controller;

use App\Entity\InventaireBourse;
use App\Entity\Personnage;
use App\Entity\RangGuilde;
use App\Entity\User;
use App\Entity\ValeurCaract;
use App\Form\PersonnageType;
use App\Repository\PersonnageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PersonnageController extends AbstractController
{
    /**
     * @Route("/liste/personnage", name="personnage_index", methods={"GET"})
     */
    public function index(PersonnageRepository $personnageRepository): Response
    {

        return $this->render('personnage/index.html.twig', [
            'personnages' => $personnageRepository->findAll(),
        ]);
    }


//    /**
//     * @Route("/liste/personnage/{idUser}", name="personnage_index", methods={"GET"})
//     */
//    public function index(PersonnageRepository $personnageRepository,User $idUser): Response
//    {
//        $user=$this->searchUserAction($idUser);
//
//        return $this->render('personnage/index.html.twig', [
//            'personnages' => $user->getPersonnages(),
//        ]);
//    }

    /**
     * @Route("/create/personnage/{idUser}", name="personnage_new", methods={"GET","POST"})
     * @Route("/add/personnage/{idUser}", name="personnage_new_user", methods={"GET","POST"})
     */
    public function new(Request $request, User $idUser): Response
    {
        $user = $this->searchUserAction($idUser);


        $personnage = new Personnage();
        $form = $this->createForm(PersonnageType::class, $personnage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();


            $bourse = new InventaireBourse();

            $bourse->setValeurBoursePerso(0);
            $personnage->setInventaireBourse($bourse);


            $caractPrincipaux = $this->recuperationCaracteristiquePrincipal();
            $caractSecondaires = $this->recuperationCaracteristiqueSecondaire();


            foreach ($caractPrincipaux as $caractPrincipal) {
                $valeurCaract = new ValeurCaract();
                $valeurCaract->setCaracteristique($caractPrincipal);
                $valeurCaract->setPersonnage($personnage);
                $nbr1 = rand(1, 6);
                $nbr2 = rand(1, 6);
                $nbr3 = rand(1, 6);
                $nbrTotal = $nbr1 + $nbr2 + $nbr3;

                $valeurCaract->setValeur($nbrTotal);
                $entityManager->persist($valeurCaract);

            }


            foreach ($caractSecondaires as $caractSecondaire) {
                $valeurCaract = new ValeurCaract();
                $valeurCaract->setCaracteristique($caractSecondaire);
                $valeurCaract->setPersonnage($personnage);
                $nbr1 = rand(1, 6);
                $nbr2 = rand(1, 6);
                $nbr3 = rand(1, 6);
                $nbrTotal = $nbr1 + $nbr2 + $nbr3;

                $valeurCaract->setValeur($nbrTotal);
                $entityManager->persist($valeurCaract);

            }

//            var_dump($form['guilde']->getData()->getId());

//            if (empty($personnage->getGuilde()->getId())) {
//
//            } else {
//                $guilde = $this->searchGuildBy($personnage->getGuilde());
//                var_dump($guilde);
//                $rangGuide = new RangGuilde();
//                $rangGuide->setGuilde($guilde)
//                    ->setPersonnage($personnage)
//                    ->setRang('soldat');
//
//                $entityManager->persist($rangGuide);
//
//            }


            $user->addPersonnage($personnage);
            $entityManager->persist($user);
            $entityManager->persist($personnage);
            $entityManager->flush();

            return $this->redirectToRoute('personnage_index');
        }

        return $this->render('personnage/new.html.twig', [
            'personnage' => $personnage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/detail/personnage/{id}", name="personnage_show", methods={"GET"})
     */
    public function show(Personnage $personnage): Response
    {
        return $this->render('personnage/show.html.twig', [
            'personnage' => $personnage,
        ]);
    }

    /**
     * @Route("/editer/personnage/{id}", name="personnage_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Personnage $personnage): Response
    {
        $form = $this->createForm(PersonnageType::class, $personnage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('personnage_index', [
                'id' => $personnage->getId(),
            ]);
        }

        return $this->render('personnage/edit.html.twig', [
            'personnage' => $personnage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="personnage_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Personnage $personnage): Response
    {
        if ($this->isCsrfTokenValid('delete' . $personnage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($personnage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('personnage_index');
    }


    private function searchUserAction(User $user)
    {
        $repositoryUser = $this->getDoctrine()->getRepository('App:User');
        //on récupère l'id de la siuation
        // on recuper les info d'une situation precise
        $infoUser = $repositoryUser->find($user);

        return $infoUser;
    }


    private function recuperationCaracteristiquePrincipal()
    {
        $repositoryCaractPrin = $this->getDoctrine()->getRepository('App:CaracteristiquePrincipal');

        $allCaractPricipe = $repositoryCaractPrin->findAll();

        return $allCaractPricipe;
    }


    private function recuperationCaracteristiqueSecondaire()
    {
        $repositoryCaractSecondaire = $this->getDoctrine()->getRepository('App:CaracteristiqueSecondaire');

        $allCaractSecondaire = $repositoryCaractSecondaire->findAll();

        return $allCaractSecondaire;
    }


//    private function searchGuildBy($guilde)
//    {
//        $repositoryGuilde = $this->getDoctrine()->getRepository('App:Guilde');
//        $infoGuilde = $repositoryGuilde->findOneBy(array('nomGuilde' => $guilde));
//
//        return $infoGuilde;
//    }
}
