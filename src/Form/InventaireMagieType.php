<?php

namespace App\Form;

use App\Entity\InventaireMagie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InventaireMagieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomItemInventaire')
            ->add('descriptionItemInventaire')
            ->add('poidsItemInventaire')
            ->add('beneficeMaluceInventaire')
            ->add('valeurInventaire')
            ->add('degatMagieInventaire')
            ->add('coutManaMagieInventaire')
            ->add('niveauMagieInventaire')
            ->add('typesDes')
            ->add('monnaie')
            ->add('fichier')
            ->add('personnages')
            ->add('typeMagieInventaire')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => InventaireMagie::class,
        ]);
    }
}
