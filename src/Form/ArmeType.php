<?php

namespace App\Form;

use App\Entity\Arme;
use App\Entity\Fichier;
use App\Entity\Materiel;
use App\Entity\Monnaie;
use App\Entity\TypeArme;
use App\Entity\TypeCategorie;
use App\Entity\TypeDes;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArmeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomItem',TextType::class)
            ->add('descriptionItem',TextareaType::class, array('required'   => false))
            ->add('poids',NumberType::class)
            ->add('beneficeMaluce',TextareaType::class, array('required'   => false))
            ->add('valeur',NumberType::class)
            ->add('degat',NumberType::class)
            ->add('typeDes', EntityType::class,
                array('class'=>TypeDes::class,
                    'label'=>'Dés',
                    'choice_label'=>'des')
            )
            ->add('imageAvInsertion', FileType::class,
                array('data_class' => null,
                    'required'=>false
    )
            )
            ->add('monnaie',EntityType::class
            ,array('class'=>Monnaie::class,
                    'label'=>'Monnaie',
                    'choice_label'=>'nomMonnaie'))

            ->add('typeArme', EntityType::class,
                array('class'=>TypeArme::class,
                    'label'=> "Type d'arme ",
                    'choice_label'=>"nomTypeArme")
            )
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Arme::class,
        ]);
    }
}
