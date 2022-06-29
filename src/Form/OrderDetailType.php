<?php

namespace App\Form;

use Doctrine\DBAL\Types\FloatType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class OrderDetailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('quantity', IntegerType::class,
        [
            'label' => 'OrderDetail',
            'required' => true,
            'attr' => [
                'min' => 520000,
                'max' => 565265652
            ]
        ] )
        ->add('unitprice', FloatType::class,
        [
            'label' => 'UnitPrice',
                'required' => true,
                'attr' =>[
                    'min' => 520000,
                    'max' => 5415015445
                ]
        ])
        ->add('orderdetail', Entity::class,
            [
                'label' => 'OrderDetail name',
                'required' => true,
                'class' => OrderDetail::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
