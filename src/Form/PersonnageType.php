<?php

namespace App\Form;

use App\Entity\ClassePersonnage;
use App\Entity\Langue;
use App\Entity\Personnage;
use PackageVersions\FallbackVersions;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonnageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomPersonnage',TextType::class)
            ->add('PrenomPersonnage',TextType::class)
            ->add('DescriptionPersonnege',TextareaType::class)
            ->add('sexe',TextType::class)
            ->add('age',NumberType::class)
            ->add('poids',NumberType::class)
            ->add('taille',NumberType::class)
            ->add('niveau',NumberType::class)
            ->add('collLangues',EntityType::class,
                array('class'=>Langue::class,
                    'label'=>"Langue parlé",
                    "choice_label"=>"nomLangue",
                    'expanded'=>false,
                    'multiple'=>true))
//            ->add('inventaireBourse')
//            ->add('user')
//            ->add('inventaire')
            ->add('classe',EntityType::class,
                array('class'=>ClassePersonnage::class,
                    'label'=>"Classe",
                    "choice_label"=>"nomClasse",
                    'expanded'=>false,
                    'multiple'=>false))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Personnage::class,
        ]);
    }
}
