<?php

namespace App\Form;

use App\Entity\InventaireArme;
use App\Entity\InventaireArmure;
use App\Entity\Personnage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonnageInventaireArmureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('itemsBefore',EntityType::class,
                array(
                    'class'=>InventaireArmure::class,
                    'label'=>'Armure',
                    'choice_label'=>'nomItemInventaire',
                    'expanded'=>true,
                    'multiple'=>true
                ))
//      ->add('nbrArmePosseder',NumberType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Personnage::class,
        ]);
    }
}
