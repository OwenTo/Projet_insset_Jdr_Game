<?php

namespace App\Form;

use App\Entity\Compagnon;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompagnonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Sexe')
            ->add('prixAchatVente')
            ->add('compagnonType')
            ->add('race')
//            ->add('personnage')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Compagnon::class,
        ]);
    }
}
