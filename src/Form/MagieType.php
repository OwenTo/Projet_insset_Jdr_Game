<?php

namespace App\Form;

use App\Entity\Magie;
use App\Entity\Monnaie;
use App\Entity\TypeDes;
use App\Entity\TypeMagie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MagieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomItem')
            ->add('descriptionItem')
            ->add('poids')
            ->add('beneficeMaluce')
            ->add('valeur')
            ->add('degatMagie')
            ->add('coutDeMana')
            ->add('niveauMagie')
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
            ->add('typeMagies', EntityType::class,
                array('class' => TypeMagie::class,
                    'label' => 'Elementaire',
                    'choice_label' => 'nomTypeMagie',
                    'expanded' => true,
                    'multiple' => true
//                , 'data'=>$options['defaultTypeMagie']
                )
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Magie::class,
        ]);
//        $resolver->setRequired(array('defaultTypeMagie'));
    }
}
