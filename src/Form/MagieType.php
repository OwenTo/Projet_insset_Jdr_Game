<?php

namespace App\Form;

use App\Entity\Magie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MagieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomItem')
            ->add('descriptionItem')
            ->add('fichier')
            ->add('poids')
            ->add('beneficeMaluce')
            ->add('valeur')
            ->add('degatMagie')
            ->add('coutDeMana')
            ->add('niveauMagie')
            ->add('typeDes')
            ->add('monnaie')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Magie::class,
        ]);
    }
}
