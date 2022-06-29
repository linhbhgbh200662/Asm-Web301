<?php

namespace App\Form;

use App\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;

class OrdersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('quantity', IntegerType::class,
        [
            'label' => 'Orders',
            'required' => true,
            'attr' => [
                'min' => 520000,
                'max' => 565265652
            ]
        ] )
        ->add('date', DateType::class,
        [
            'label' => 'Date',
            // 'widget' = 'single_text'
        ] )
        ->add('customer', Entity::class,
        [
            'label' => 'Customer name',
                'required' => true,
                'class' => Customer::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false
            ])
            ->add('Save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
    
}
