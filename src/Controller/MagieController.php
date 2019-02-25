<?php

namespace App\Controller;

use App\Entity\Fichier;
use App\Entity\InventaireMagie;
use App\Entity\Magie;
use App\Entity\Materiel;
use App\Entity\Personnage;
use App\Entity\TypeMagie;
use App\Form\MagieType;
use App\Repository\MagieRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class MagieController extends AbstractController
{
    /**
     * @Route("/liste/magie", name="magie_index", methods={"GET"})
     */
    public function index(MagieRepository $magieRepository): Response
    {
        return $this->render('magie/index.html.twig', ['magies' => $magieRepository->findAll()]);
    }

    /**
     * @Route("/create/magie", name="magie_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {

        // on recupére le type de la magie par défaut
//        $em = $this->getDoctrine()->getRepository(TypeMagie::class);
//        $defautTypeMagie = $em->find(1);


        $magie = new Magie();
        $form = $this->createForm(MagieType::class, $magie);

//        $form = $this->createForm(MagieType::class, $magie,
//            array('defaultTypeMagie' => $defautTypeMagie));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

//
//            $fichier = new Fichier();
//            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
//
//            $file = $form->get('imageAvInsertion')->getData();
////                $file=$form['fichier']->getData();
//            $fileName = md5(uniqid());
//            // Move the file to the directory where brochures are stored
//            $fileNameExtension = $fileName . '.' . $file->guessExtension();
//
//            $file->move($this->getParameter('upload_directory'), $fileNameExtension);
//            $path_parts = pathinfo($fileNameExtension);


            $fichier = new Fichier();

            $uploaFile = new FileUploader($this->getParameter('upload_directory'));


            $file = $form->get('imageAvInsertion')->getData();

            $fileName = $uploaFile->upload($file);

            $path_parts = pathinfo($fileName);


            $fichier->setContenueFichier($fileName);
            $fichier->setFichierExtension($path_parts['extension']);


            $dateCrea = new \DateTime('Now ', new \DateTimeZone('Europe/Paris'));
            $fichier->setCreateFileAt($dateCrea);
            $entityManager->persist($fichier);
            $magie->setFichier($fichier);

//

            $entityManager->persist($magie);



            ///Duplicat
            $itemInventaireMagie = new InventaireMagie();
            $itemInventaireMagie->setNomItemInventaire($magie->getNomItem())
                ->setDescriptionItemInventaire($magie->getDescriptionItem())
                ->setPoidsItemInventaire($magie->getPoids())
                ->setBeneficeMaluceInventaire($magie->getBeneficeMaluce()
                )
                ->setValeurInventaire($magie->getValeur())
                ->setTypesDes($magie->getTypeDes())
                ->setMonnaie($magie->getMonnaie())
                ->setDegatMagieInventaire($magie->getDegatMagie())
                ->setCoutManaMagieInventaire($magie->getCoutDeMana())
                ->setNiveauMagieInventaire($magie->getNiveauMagie());

            foreach ($magie->getTypeMagie() as $typeMagie) {
                $itemInventaireMagie->addTypeMagieInventaire($typeMagie);
            }


            $uploadFileInventaire = new FileUploader($this->getParameter('upload_directory_inventaire'));


            if(!is_dir($uploadFileInventaire->getTargetDirectory())){mkdir($uploadFileInventaire->getTargetDirectory());};
            copy($uploaFile->getTargetDirectory()."/".$path_parts['basename'],$uploadFileInventaire->getTargetDirectory()."/".$path_parts['basename']);


            $fichierInventaire = new Fichier();
            $fichierInventaire->setCreateFileAt($magie->getFichier()->getCreateFileAt())
                ->setContenueFichier($path_parts['basename'])
//            ->setContenueFichier($fileName)
                ->setFichierExtension($magie->getFichier()->getFichierExtension());


            $itemInventaireMagie->setFichier($fichierInventaire);
            $entityManager->persist($fichierInventaire);
            $entityManager->persist($itemInventaireMagie);
            /// Fin Duplicat



            $entityManager->flush();

            return $this->redirectToRoute('magie_index');
        }

        return $this->render('magie/new.html.twig', [
            'magie' => $magie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/detail/magie/{id}", name="magie_show", methods={"GET"})
     */
    public function show(Magie $magie): Response
    {
        return $this->render('magie/show.html.twig', ['magie' => $magie]);
    }

    /**
     * @Route("/edit/magie/{id}", name="magie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Magie $magie): Response
    {
        $form = $this->createForm(MagieType::class, $magie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            if ($magie->getImageAvInsertion() == null || empty($magie->getImageAvInsertion())) {
            } else {

                $filDir = $this->getParameter('upload_directory');
                unlink($filDir . "/" . $magie->getFichier()->getContenueFichier());


                /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */

                $file = $form->get('imageAvInsertion')->getData();
//                $file=$form['fichier']->getData();
                $fileName = md5(uniqid());
                // Move the file to the directory where brochures are stored
                $fileNameExtension = $fileName . '.' . $file->guessExtension();

                $file->move($this->getParameter('upload_directory'), $fileNameExtension);
                $path_parts = pathinfo($fileNameExtension);

                $dateModif = new \DateTime('Now ', new \DateTimeZone('Europe/Paris'));

                $magie->getFichier()->setContenueFichier($fileNameExtension);
                $magie->getFichier()->setFichierExtension($path_parts['extension']);
                $magie->getFichier()->setModifFileAt($dateModif);


            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('magie_index', ['id' => $magie->getId()]);
        }

        return $this->render('magie/edit.html.twig', [
            'magie' => $magie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/supression/magie/{id}", name="magie_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Magie $magie): Response
    {
        if ($this->isCsrfTokenValid('delete' . $magie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();

            if (!empty($magie->getFichier())) {
                $filDir = $this->getParameter('upload_directory');
                unlink($filDir . "/" . $magie->getFichier()->getContenueFichier());

            }


            $entityManager->remove($magie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('magie_index');
    }


    private function createMagieItems(Magie $magie, UploadedFile $file)
    {
        $entityManager = $this->getDoctrine()->getManager();


        $entityManager->flush();




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
     * @Route("/liste/inventaire/magie/personnage/{idPersonnage}", name="inventaire_magie_personnage_index", methods={"GET"})

     */
    public function indexPersonnageArme(Personnage $idPersonnage): Response
    {
        $personnage=$this->searchPersonnageAction($idPersonnage);
        $repositoryInventaireMagie = $this->getDoctrine()->getRepository('App:InventaireMagie');

        $inventaires =$repositoryInventaireMagie->findInventaireMagie($personnage->getId());
        return $this->render('inventaire_magie/index.html.twig', [
            'inventaire_magies' =>$inventaires,
//            'inventaire_armes' => $inventaireArmeRepository->findAll(),
        ]);
    }





}
