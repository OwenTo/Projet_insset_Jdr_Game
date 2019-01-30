<?php

namespace App\Form;

use App\Entity\Armure;
use App\Entity\Equipement;
use App\Entity\Materiel;
use App\Entity\Monnaie;
use App\Entity\TypeArme;
use App\Entity\TypeCategorie;
use App\Entity\TypeDes;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArmureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomItem')
            ->add('descriptionItem')
            ->add('poids')
            ->add('beneficeMaluce')
            ->add('valeur')

            ->add('defense')



            ->add('typeDes', EntityType::class,
                array('class'=>TypeDes::class,
                    'label'=>'Dés',
                    'choice_label'=>'des')
            )
            ->add('imageAvInsertion', FileType::class,
                array('data_class' => null,
                    'label'=>'Image ',
                    'required'=>false
                )
            )
            ->add('monnaie',EntityType::class
                ,array('class'=>Monnaie::class,
                    'label'=>'Monnaie',
                    'choice_label'=>'nomMonnaie'))


            ->add('typeCategorie', EntityType::class,
                array('class'=>TypeCategorie::class,
                    'label'=>'Categorie',
                    'choice_label'=>'categorie')
            )
            ->add('materiel', EntityType::class,
                array('class'=>Materiel::class,
                    'label'=>"Materiel de l'objet",
                    'choice_label'=>'typeMateriel')
            )
//           ')
            ->add('equipement',EntityType::class,
                array('class'=>Equipement::class,
                    'label'=>"Partie de l'équipement",
                    'choice_label'=>"nomEquipement")
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Armure::class,
        ]);
    }
}
