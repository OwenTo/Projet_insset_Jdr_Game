<?php

namespace App\Form;

use App\Entity\Partie;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PartieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomPartie')
            ->add('joueurs',EntityType::class,
                array('class'=>User::class,
                    'label'=>"joueur potentiel",
                    'choice_label'=>"username",
                    'expanded'=>true,
                    'multiple'=>true))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Partie::class,
        ]);
    }
}
