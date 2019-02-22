<?php

namespace App\Controller;

use App\Entity\Arme;
use App\Entity\Fichier;
use App\Entity\InventaireArme;
use App\Form\ArmeType;
use App\Repository\ArmeRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ArmeController extends AbstractController
{
    /**
     * @Route("/liste/arme", name="arme_index", methods={"GET"})
     */
    public function index(ArmeRepository $armeRepository): Response
    {
        return $this->render('arme/index.html.twig', ['armes' => $armeRepository->findAll()]);
    }

    /**
     * @Route("/create/arme", name="arme_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $arme = new Arme();
        $form = $this->createForm(ArmeType::class, $arme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();


            $fichier = new Fichier();

            $uploaFile = new FileUploader($this->getParameter('upload_directory'));


            $file = $form->get('imageAvInsertion')->getData();

            $fileName = $uploaFile->upload($file);

            $path_parts = pathinfo($fileName);
//            $path_parts = pathinfo($fileNameExtension);

            $fichier->setContenueFichier($fileName);
            $fichier->setFichierExtension($path_parts['extension']);


            $dateCrea = new \DateTime('Now ', new \DateTimeZone('Europe/Paris'));
            $fichier->setCreateFileAt($dateCrea);
            $entityManager->persist($fichier);
            $arme->setFichier($fichier);


            $entityManager->persist($arme);

            $this->createArmeItems($arme, $file);

            $entityManager->flush();


            return $this->redirectToRoute('arme_index');
        }

        return $this->render('arme/new.html.twig', [
            'arme' => $arme,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/detail/arme/{id}", name="arme_show", methods={"GET"})
     */
    public function show(Arme $arme): Response
    {
        return $this->render('arme/show.html.twig', ['arme' => $arme]);
    }

    /**
     * @Route("/edit/arme{id}", name="arme_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Arme $arme): Response
    {
        $form = $this->createForm(ArmeType::class, $arme);
        $form->handleRequest($request);
        $filDir = $this->getParameter('upload_directory');
        if ($form->isSubmitted() && $form->isValid()) {

            if ($arme->getImageAvInsertion() == null || empty($arme->getImageAvInsertion())) {
            } else {


                unlink($filDir . "/" . $arme->getFichier()->getContenueFichier());

                $uploaFile = new FileUploader($this->getParameter('upload_directory'));


                $file = $form->get('imageAvInsertion')->getData();

                $fileName = $uploaFile->upload($file);

                $path_parts = pathinfo($fileName);
//

                $dateModif = new \DateTime('Now ', new \DateTimeZone('Europe/Paris'));

                $arme->getFichier()->setContenueFichier($fileName);
                $arme->getFichier()->setFichierExtension($path_parts['extension']);
                $arme->getFichier()->setModifFileAt($dateModif);


            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('arme_index', ['id' => $arme->getId()]);
        }

        return $this->render('arme/edit.html.twig', [
            'arme' => $arme,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/suppression/arme/{id}", name="arme_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Arme $arme): Response
    {
        if ($this->isCsrfTokenValid('delete' . $arme->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();

            if (!empty($arme->getFichier())) {
                $filDir = $this->getParameter('upload_directory');
                unlink($filDir . "/" . $arme->getFichier()->getContenueFichier());

            }

            $entityManager->remove($arme);
            $entityManager->flush();
        }

        return $this->redirectToRoute('arme_index');
    }


    private function createArmeItems(Arme $arme, UploadedFile $file)
    {


//        var_dump($file . " test ");

        $entityManager = $this->getDoctrine()->getManager();


        $itemInventaireArme = new InventaireArme();
        $itemInventaireArme->setNomItemInventaire($arme->getNomItem())
            ->setDescriptionItemInventaire($arme->getDescriptionItem())
            ->setPoidsItemInventaire($arme->getPoids())
            ->setBeneficeMaluceInventaire($arme->getBeneficeMaluce())
            ->setValeurInventaire($arme->getValeur())
            ->setTypesDes($arme->getTypeDes())
            ->setMonnaie($arme->getMonnaie())
            ->setMaterielInventaire($arme->getMateriel())
            ->setTypeArmeInventaire($arme->getTypeArme())
            ->setTypeCategorieInventaire($arme->getTypeCategorie())
            ->setDegatArmeInventaire($arme->getDegat());


//        $uploadFileInventaire = new FileUploader($this->getParameter('upload_directory_inventaire'));
//
//
//        $fileName = $uploadFileInventaire->upload($file);
//        var_dump($fileName);

//        $filInventaireName = $fileName;
//        var_dump($uploadFileInventaire);
        $filInventaireName = $arme->getFichier()->getContenueFichier();
        $fichierInventaire = new Fichier();
        $fichierInventaire->setCreateFileAt($arme->getFichier()->getCreateFileAt());
        $fichierInventaire->setContenueFichier($filInventaireName);
        $fichierInventaire->setFichierExtension($arme->getFichier()->getFichierExtension());


        $itemInventaireArme->setFichier($fichierInventaire);


        $entityManager->persist($fichierInventaire);
        $entityManager->persist($itemInventaireArme);
        $entityManager->flush();
    }
}
