<?php

namespace App\Form;

use App\Entity\InventaireArmure;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InventaireArmureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomItemInventaire')
            ->add('descriptionItemInventaire')
            ->add('poidsItemInventaire')
            ->add('beneficeMaluceInventaire')
            ->add('valeurInventaire')
            ->add('defenseArmureInventaire')
            ->add('typesDes')
            ->add('monnaie')
            ->add('fichier')
            ->add('personnages')
            ->add('equipementInventaire')
            ->add('categorieArmureInventaire')
            ->add('materielArmureInventaire')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => InventaireArmure::class,
        ]);
    }
}
