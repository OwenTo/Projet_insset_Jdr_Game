<?php

namespace App\Form;

use App\Entity\InventaireArme;
use App\Entity\Personnage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonnageInventaireArmeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('inventaire',EntityType::class,array('class'=>InventaireArme::class,
              'label'=>"arme",
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
