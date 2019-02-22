<?php

namespace App\Form;

use App\Entity\InventaireArme;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InventaireArmeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomItemInventaire')
            ->add('descriptionItemInventaire')
            ->add('poidsItemInventaire')
            ->add('beneficeMaluceInventaire')
            ->add('valeurInventaire')
            ->add('degatArmeInventaire')
            ->add('typesDes')
            ->add('monnaie')
            ->add('fichier')
            ->add('personnages')
            ->add('typeArmeInventaire')
            ->add('typeCategorieInventaire')
            ->add('materielInventaire')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => InventaireArme::class,
        ]);
    }
}
