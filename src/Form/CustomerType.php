<?php

namespace App\Form;

use App\Entity\Orders;
use App\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;

class CustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,
            [
                'label' => 'Full name',
                'attr' => 
                [
                    'minlenghth' => 2,
                    'maxlenghth' => 25
                ]
            ])
            ->add('address', ChoiceType::class,
            [
                'label' => 'Campus',
                'require' => true,
                'choices' => [
                    'Ha Noi' => 'Ha Noi',
                    'HCM City' => 'HCM City',
                    'Da Nang' => 'Da Nang',
                    'Ha Nam' => 'Ha Nam',
                ],
                'multiple' => false,
                'expanded' => true
            ])
            -> add('dateofbirth', DateType::class,
            [
                'label' => 'Date of birth',
                'widget' => 'single_text'
            ])
            ->add('orders', Entity::class,
            [
                'label' => 'Orders name',
                'required' => true,
                'class' => Orders::class,
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
            'data_class' => Customer::class,
            // Configure your form options here
        ]);
    }
}
