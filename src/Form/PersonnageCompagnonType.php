<?php

namespace App\Form;

use App\Entity\ClassePersonnage;
use App\Entity\Compagnon;
use App\Entity\Guilde;
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

class PersonnageCompagnonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder


        ->add('collCompagnons',EntityType::class,
            array('class'=>Compagnon::class,
                'label'=>'Compagnon',
                'choice_label'=>'nomCompagnon',
                'expanded'=>true,
                'multiple'=>true,
                'required'   => false))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Personnage::class,
        ]);
    }
}
