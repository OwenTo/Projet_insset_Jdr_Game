<?php

namespace App\Form;

use App\Entity\Guilde;
use App\Entity\TypeGuilde;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GuildeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomGuilde',TextType::class)
            ->add('MaitreGuilde',TextType::class)
            ->add('typeGuilde',EntityType::class,
                array('class'=>TypeGuilde::class,
                    'label'=>"Catégorie de Guilde",
                    'choice_label'=>"typeGuilde"))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Guilde::class,
        ]);
    }
}
