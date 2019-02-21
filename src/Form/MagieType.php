<?php

namespace App\Form;

use App\Entity\Magie;
use App\Entity\Monnaie;
use App\Entity\TypeDes;
use App\Entity\TypeMagie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MagieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomItem',TextType::class)
            ->add('descriptionItem',TextareaType::class, array('required'   => false))
            ->add('poids',NumberType::class)
            ->add('beneficeMaluce',TextareaType::class, array('required'   => false))
            ->add('valeur',NumberType::class)
            ->add('degatMagie',NumberType::class)
            ->add('coutDeMana',NumberType::class)
            ->add('niveauMagie',NumberType::class)
            ->add('typeDes', EntityType::class,
                array('class' => TypeDes::class,
                    'label' => 'Dés',
                    'choice_label' => 'des')
            )
            ->add('imageAvInsertion', FileType::class,
                array('data_class' => null,
                    'label' => 'Image ',
                    'required' => false
                )
            )
            ->add('monnaie', EntityType::class
                , array('class' => Monnaie::class,
                    'label' => 'Monnaie',
                    'choice_label' => 'nomMonnaie'))
            ->add('typeMagie', EntityType::class,
                array('class' => TypeMagie::class,
                    'label' => 'Elementaire',
                    'choice_label' => 'nomTypeMagie',
                    'expanded' => true,
                    'multiple' => true
                )
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Magie::class,
        ]);
    }
}
