<?php

namespace App\Form;

use App\Entity\Guilde;
use App\Entity\RangGuilde;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RangGuildeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('rang',TextType::class)
            ->add('guilde',EntityType::class,
                array('class'=>Guilde::class,
                    'label'=>'guilde',
                    'choice_label'=>'nomGuilde',
                    'expanded'=>false,
                    'multiple'=>false))
//            ->add('personnage')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RangGuilde::class,
        ]);
    }
}
