<?php

namespace App\Form;

use App\Entity\Personnage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonnageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomPersonnage')
            ->add('PrenomPersonnage')
            ->add('DescriptionPersonnege')
            ->add('sexe')
            ->add('age')
            ->add('poids')
            ->add('taille')
            ->add('niveau')
            ->add('collLangues')
            ->add('inventaireBourse')
            ->add('user')
            ->add('inventaire')
            ->add('classe')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Personnage::class,
        ]);
    }
}
