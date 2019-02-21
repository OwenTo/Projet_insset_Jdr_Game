<?php

namespace App\Controller;

use App\Entity\Arme;
use App\Entity\Fichier;
use App\Entity\InventaireArme;
use App\Entity\InventaireItem;
use App\Form\ArmeType;
use App\Repository\ArmeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;


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
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */

            $file = $form->get('imageAvInsertion')->getData();
//                $file=$form['fichier']->getData();
            $fileName = md5(uniqid());
            // Move the file to the directory where brochures are stored
            $fileNameExtension = $fileName . '.' . $file->guessExtension();

//            $file->move($this->getParameter('upload_directory'), $fileNameExtension);
            $file->move($this->getParameter('upload_directory'), $fileNameExtension);



            $path_parts = pathinfo($fileNameExtension);

            $fichier->setContenueFichier($fileNameExtension);
            $fichier->setFichierExtension($path_parts['extension']);


            $dateCrea = new \DateTime('Now ', new \DateTimeZone('Europe/Paris'));
            $fichier->setCreateFileAt($dateCrea);
            $entityManager->persist($fichier);
            $arme->setFichier($fichier);




            $entityManager->persist($arme);

//            var_dump($arme->getNomItem());
            $this->createArmeItems($arme,$fichier,$file);

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


                /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */

                $file = $form->get('imageAvInsertion')->getData();
//                $file=$form['fichier']->getData();
                $fileName = md5(uniqid());
                // Move the file to the directory where brochures are stored
                $fileNameExtension = $fileName . '.' . $file->guessExtension();

                $file->move($this->getParameter('upload_directory'), $fileNameExtension);
                $path_parts = pathinfo($fileNameExtension);

                $dateModif = new \DateTime('Now ', new \DateTimeZone('Europe/Paris'));

                $arme->getFichier()->setContenueFichier($fileNameExtension);
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

            if (!empty($arme->getFichier())){
                $filDir = $this->getParameter('upload_directory');
                unlink($filDir . "/" . $arme->getFichier()->getContenueFichier());

            }

            $entityManager->remove($arme);
            $entityManager->flush();
        }

        return $this->redirectToRoute('arme_index');
    }


    private function createArmeItems(Arme $arme ,Fichier $fichier ,$file){


        $entityManager = $this->getDoctrine()->getManager();


        $itemInventaireArme = new InventaireArme();
        $itemInventaireArme->setNomItemInventaire($arme->getNomItem()."invent")
            ->setDescriptionItemInventaire($arme->getDescriptionItem())
            ->setPoidsItemInventaire($arme->getPoids())
            ->setBeneficeMaluceInventaire($arme->getBeneficeMaluce())
            ->setValeurInventaire($arme->getValeur())
            ->setTypesDes($arme->getTypeDes())
            ->setMonnaie($arme->getMonnaie())
            ->setMaterielInventaire($arme->getMateriel())
            ->setTypeArmeInventaire($arme->getTypeArme())
            ->setTypeCategorieInventaire($arme->getTypeCategorie())

            ->setDegatArmeInventaire($arme->getDegat())
        ;


        $fichierInventaire = new Fichier();



        $filInventaireName =  "test_".$fichier->getContenueFichier();

        $file2=$file;

        $file2->move($this->getParameter('upload_directory_inventaire'), $filInventaireName);



        $fichierInventaire->setCreateFileAt($fichier->getCreateFileAt());
        $fichierInventaire->setContenueFichier($filInventaireName);
        $fichierInventaire->setFichierExtension($fichier->getFichierExtension());

        $entityManager->persist($fichierInventaire);
        $itemInventaireArme->setFichier($fichierInventaire);




        $entityManager->persist($itemInventaireArme);
        var_dump($itemInventaireArme->getNomItemInventaire());
        $entityManager->flush();
    }
}
