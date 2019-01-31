<?php

namespace App\Form;

use App\Entity\Talent;

use App\Entity\TypeTalent;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TalentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descriptionTalent',TextareaType::class)
            ->add('nomTalent',TextType::class)
            ->add('beneficeMaluceTalent',TextareaType::class)
->add('typeTalent',EntityType::class,
    array('class'=>TypeTalent::class,
        'label'=>"Types de talent",
        'choice_label'=>'nomTypeTalent',
        'expanded'=>false,
        'multiple'=>false))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Talent::class,
        ]);
    }
}
