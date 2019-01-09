<?php

namespace App\Form;

use App\Entity\Arme;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArmeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomItem')
            ->add('descriptionItem')
            ->add('poids')
            ->add('beneficeMaluce')
            ->add('valeur')
            ->add('degat')
            ->add('typeDes')
            ->add('fichier')
            ->add('monnaie')
            ->add('typeArme')
            ->add('typeCategorie')
            ->add('materiel')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Arme::class,
        ]);
    }
}
