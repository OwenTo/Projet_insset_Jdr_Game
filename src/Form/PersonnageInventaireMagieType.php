<?php

namespace App\Form;

use App\Entity\InventaireMagie;
use App\Entity\Personnage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonnageInventaireMagieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('inventaire',EntityType::class,
                array('class'=>InventaireMagie::class,
                    'label'=>"magie",
                    "choice_label"=>"nomItemInventaire",
                    'expanded'=>true,
                    'multiple'=>true)
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Personnage::class,
        ]);
    }
}
