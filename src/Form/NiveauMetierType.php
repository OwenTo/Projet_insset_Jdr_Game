<?php

namespace App\Form;

use App\Entity\Metier;
use App\Entity\NiveauMetier;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NiveauMetierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('niveauMetier',NumberType::class)
            ->add('metier',EntityType::class,
                array('class'=>Metier::class,
                    'label'=>"Métier",
                    'choice_label'=>"nomMetier",
                    'expanded'=>false,
                    'multiple'=>false))
//            ->add('personnage')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => NiveauMetier::class,
        ]);
    }
}
