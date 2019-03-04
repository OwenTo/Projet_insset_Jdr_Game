<?php

namespace App\Form;

use App\Entity\ChoixPersonnage;
use App\Entity\Personnage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChoixPersonnageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('partie')
            ->add('personnage',ChoiceType::class,
                array('choices'=>$options['personnages'])
            )

//        ->add('player',EntityType::class,
//                ['class'=>Personnage::class,
//                    'label'=>'choisissez votre personnage :',
//                    'choice_label'=>"nomPersonnage",
//                    'mapped'=>false
//                    ,'required'=>false,
////                    'choices'=>$form->getData()->getuser()->getPersonnage()
//                ])
        ;
//        $builder->get('player')->addEventListener(
//            FormEvents::POST_SUBMIT,function (FormEvent $event){
//                dump($event->getForm());
//                dump($event->getForm()->getData());
//
//                $form=$event->getForm();
//        }
//        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ChoixPersonnage::class,
        ]);
    }
}
