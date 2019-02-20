<?php

namespace App\Form;

use App\Entity\Compagnon;
use App\Entity\Race;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompagnonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomCompagnon',TextType::class)
            ->add('Sexe',TextType::class)
            ->add('prixAchatVente',NumberType::class)
            ->add('compagnonType',EntityType::class,
                array('class'=>\App\Entity\CompagnonType::class,
                    'label'=>"Catégorie du Compagnon",
                    'choice_label'=>'typeCompagnon'))
            ->add('race',EntityType::class,
                array('class'=>Race::class,
                    'label'=>"Race du Compagnon",
                    'choice_label'=>'nomRace'))
//            ->add('personnage')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Compagnon::class,
        ]);
    }
}
