<?php

namespace App\Form;

use App\Entity\CapaciteRacial;
use App\Entity\Race;
use App\Entity\TypeRace;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RaceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomRace',TextType::class)
            ->add('descriptionRace',TextareaType::class)
            ->add('typeRace',EntityType::class,
                array('class'=>TypeRace::class,
                    'label'=>"Cétégorie de la Race",
                    'choice_label'=>'typeRace',
                    'expanded'=>false,
                    'multiple'=>false))
            ->add('capaciteRacials',EntityType::class,
                array('class'=>CapaciteRacial::class,
                    'label'=>'Capacité(s) de la Race',
                    'choice_label'=>'capacite',
                    'expanded'=>true,
                    'multiple'=>true))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Race::class,
        ]);
    }
}
