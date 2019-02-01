<?php

namespace App\Controller;

use App\Entity\Fichier;
use App\Entity\User;
use App\Form\FichierType;
use App\Repository\FichierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class FichierController extends AbstractController
{
    /**
     * @Route("/liste/mes/maps/{idUser}", name="fichier_index", methods={"GET"})
     */
    public function index(FichierRepository $fichierRepository, User $idUser): Response
    {

        $user=$this->searchUserAction($idUser);
        return $this->render('fichier/index.html.twig', [
//            'fichiers' => $fichierRepository->findAll(),
            'fichiers' => $user->getMaps(), 'user'=>$user
        ]);
    }


    private function searchUserAction(User $user)
    {
        $repositoryUser = $this->getDoctrine()->getRepository('App:User');
        //on récupère l'id de la siuation
        // on recuper les info d'une situation precise
        $infoUser = $repositoryUser->find($user);

        return $infoUser;
    }


    /**
     * @Route("/add/map{idUser}", name="fichier_new", methods={"GET","POST"})
     */
    public function new(Request $request ,User $idUser): Response
    {
        $user=$this->searchUserAction($idUser);
        $fichier = new Fichier();
        $form = $this->createForm(FichierType::class, $fichier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();



            $dateCrea = new \DateTime('Now ', new \DateTimeZone('Europe/Paris'));
            $fichier->setCreateFileAt($dateCrea);

//            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $form->get('contenuFileBefore')->getData();
            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid());
            var_dump($fileName);

//

            // Move the file to the directory where brochures are stored
            $fileNameExtension = $fileName . '.' . $file->guessExtension();

            $file->move($this->getParameter('upload_directory_maps'), $fileNameExtension);
            $path_parts = pathinfo($fileNameExtension);


            $fichier->setContenueFichier($fileNameExtension);
            $fichier->setFichierExtension($path_parts['extension']);
            $user->addMap($fichier);
            $entityManager->persist($fichier);
            $entityManager->persist($user);

         $entityManager->flush();

            return $this->redirectToRoute('fichier_index',['idUser'=>$user->getId()]);
        }

        return $this->render('fichier/new.html.twig', [
            'fichier' => $fichier,
            'user'=>$user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/detail/ma/map/{id}", name="fichier_show", methods={"GET"})
     */
    public function show(Fichier $fichier): Response
    {
        return $this->render('fichier/show.html.twig', [
            'fichier' => $fichier,
        ]);
    }

    /**
     * @Route("/editer/ma/maps/{id}", name="fichier_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Fichier $fichier ,User $idUser= null): Response
    {
        $form = $this->createForm(FichierType::class, $fichier);
        $form->handleRequest($request);
        $filDir = $this->getParameter('upload_directory_maps');
        $idUser=$fichier->getUser()->getId();

        $user=$this->searchUserEditAction($idUser);
//        var_dump($infoUser);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($fichier->getContenuFileBefore() != null || !empty($fichier->getContenuFileBefore())) {
                unlink($filDir . "/" . $fichier->getContenueFichier());

//             /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */

                $file = $form->get('contenuFileBefore')->getData();
//                $file=$form['fichier']->getData();
                $fileName = md5(uniqid());
                // Move the file to the directory where brochures are stored
                $fileNameExtension = $fileName . '.' . $file->guessExtension();

                $file->move($this->getParameter('upload_directory_maps'), $fileNameExtension);
                $path_parts = pathinfo($fileNameExtension);

                $dateModif = new \DateTime('Now ', new \DateTimeZone('Europe/Paris'));

                $fichier->setContenueFichier($fileNameExtension);
                $fichier->setFichierExtension($path_parts['extension']);
                $fichier->setModifFileAt($dateModif);



            }
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('fichier_index', [
//                'id' => $fichier->getId(),
            'idUser'=>$user
            ]);
        }

        return $this->render('fichier/edit.html.twig', [
            'fichier' => $fichier,
            'user'=>$user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/supprission/ma/maps/{id}", name="fichier_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Fichier $fichier): Response
    {        $filDir = $this->getParameter('upload_directory_maps');
            $idUser=$fichier->getUser()->getId();
        $user=$this->searchUserEditAction($idUser);
        if ($this->isCsrfTokenValid('delete'.$fichier->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            unlink($filDir . "/" . $fichier->getContenueFichier());


            $entityManager->remove($fichier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('fichier_index',['idUser'=>$user->getId()]);
    }



    private function searchUserEditAction( $user)
    {
        $repositoryUser = $this->getDoctrine()->getRepository('App:User');
        //on récupère l'id de la siuation
        // on recuper les info d'une situation precise
        $infoUser = $repositoryUser->find($user);

        return $infoUser;
    }
}
