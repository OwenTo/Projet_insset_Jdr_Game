<?php

namespace App\Form;

use App\Entity\Langue;
use App\Entity\RegionLangue;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LangueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomLangue',TextType::class)
            ->add('region',EntityType::class,
                array('class'=>RegionLangue::class,
                    'label'=>"Région",
                    'choice_label'=>'regionLangue',
                    'expanded'=>false,
                    'multiple'=>false))
            ->add('langueTypes',EntityType::class,
                array('class'=>\App\Entity\LangueType::class,
                    'label'=>'Catégorie de la langue ',
                    'choice_label'=>'langueType',
                    'expanded'=>true,
                    'multiple'=>true))
//            ->add('personnages')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Langue::class,
        ]);
    }
}
