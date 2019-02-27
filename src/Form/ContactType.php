<?php

namespace App\Form;

use App\Entity\Contact;
use App\Entity\SujetMail;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nameContact',TextType::class)
            ->add('emailContact',EmailType::class)
           ->add('sujetMail',EntityType::class,
               array('class' =>SujetMail::class,
               'label'=>'sujet',
                   'choice_label'=>'sujet',
                   'required'=>false,
                   'expanded'=>false,
                   'multiple'=>false))
            ->add('sujet',TextType::class,array('label'=>'sous-sujet'))
            ->add('message',TextareaType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
