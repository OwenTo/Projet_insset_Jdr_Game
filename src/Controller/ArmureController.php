<?php

namespace App\Controller;

use App\Entity\Armure;
use App\Entity\Fichier;
use App\Form\ArmureType;
use App\Repository\ArmureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ArmureController extends AbstractController
{
    /**
     * @Route("/liste/armure", name="armure_index", methods={"GET"})
     */
    public function index(ArmureRepository $armureRepository): Response
    {
        return $this->render('armure/index.html.twig', ['armures' => $armureRepository->findAll()]);
    }

    /**
     * @Route("/create/armure", name="armure_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $armure = new Armure();
        $form = $this->createForm(ArmureType::class, $armure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();


            if(!empty($form->get('imageAvInsertion')->getData())){



            $fichier = new Fichier();
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */

            $file = $form->get('imageAvInsertion')->getData();
//                $file=$form['fichier']->getData();
            $fileName = md5(uniqid());
            // Move the file to the directory where brochures are stored
            $fileNameExtension = $fileName . '.' . $file->guessExtension();

            $file->move($this->getParameter('upload_directory'), $fileNameExtension);
            $path_parts = pathinfo($fileNameExtension);

            $fichier->setContenueFichier($fileNameExtension);
            $fichier->setFichierExtension($path_parts['extension']);


            $dateCrea = new \DateTime('Now ', new \DateTimeZone('Europe/Paris'));
            $fichier->setCreateFileAt($dateCrea);
            $entityManager->persist($fichier);
            $armure->setFichier($fichier);





            $entityManager->persist($armure);
            $entityManager->flush();

            return $this->redirectToRoute('armure_index');
            }
        }

        return $this->render('armure/new.html.twig', [
            'armure' => $armure,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/detail/armure/{id}", name="armure_show", methods={"GET"})
     */
    public function show(Armure $armure): Response
    {
        return $this->render('armure/show.html.twig', ['armure' => $armure]);
    }

    /**
     * @Route("/edit/armure/{id}", name="armure_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Armure $armure): Response
    {
        $form = $this->createForm(ArmureType::class, $armure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            if ($armure->getImageAvInsertion() == null || empty($armure->getImageAvInsertion())) {
            } else {

                $filDir = $this->getParameter('upload_directory');
                unlink($filDir . "/" . $armure->getFichier()->getContenueFichier());


                /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */

                $file = $form->get('imageAvInsertion')->getData();
//                $file=$form['fichier']->getData();
                $fileName = md5(uniqid());
                // Move the file to the directory where brochures are stored
                $fileNameExtension = $fileName . '.' . $file->guessExtension();

                $file->move($this->getParameter('upload_directory'), $fileNameExtension);
                $path_parts = pathinfo($fileNameExtension);

                $dateModif = new \DateTime('Now ', new \DateTimeZone('Europe/Paris'));

                $armure->getFichier()->setContenueFichier($fileNameExtension);
                $armure->getFichier()->setFichierExtension($path_parts['extension']);
                $armure->getFichier()->setModifFileAt($dateModif);




            }

            $this->getDoctrine()->getManager()->flush();








            return $this->redirectToRoute('armure_index', ['id' => $armure->getId()]);
        }

        return $this->render('armure/edit.html.twig', [
            'armure' => $armure,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/supression/{id}", name="armure_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Armure $armure): Response
    {
        if ($this->isCsrfTokenValid('delete'.$armure->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();

            if (!empty($armure->getFichier())){
                $filDir = $this->getParameter('upload_directory');
                unlink($filDir . "/" . $armure->getFichier()->getContenueFichier());

            }



            $entityManager->remove($armure);
            $entityManager->flush();
        }

        return $this->redirectToRoute('armure_index');
    }
}
