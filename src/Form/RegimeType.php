<?php

namespace App\Form;

use App\Entity\Plat;
use App\Entity\Regime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;




class RegimeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomRegime' )
            ->add('duree' )
            ->add('type' )
            ->add('plats', EntityType::class , [
                'class' => Plat::class,
                'choice_label' => 'nomPlat',
                'choice_value' => 'id',
                'by_reference' => false,
                'multiple' => true,
                'expanded' => false,
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Regime::class,
        ]);
    }
}
