<?php

namespace App\Form;

use App\Entity\Plat;
use App\Entity\Regime;
use App\Repository\RegimeRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $id = $options['id'];


        $builder
            ->add('nomPlat')
            ->add('cout')
            ->add('nbrCalories')
            ->add('ingredients')
            ->add('regime', EntityType::class , [
                'class' => Regime::class,
                'query_builder' => function (RegimeRepository $er) use ($id) {
                    return $er->createQueryBuilder('u')
                    ->where('u.user = :id')
                    ->setParameter('id', $id);
                },
                'placeholder' => 'Choose an option',
                'choice_label' => 'nomRegime',
                'choice_value' => 'id',
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Plat::class,
            'id' => array(),
        ]);
    }
}
