<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\CartDetail;
use App\Entity\OrderDetail;
use Doctrine\DBAL\Types\FloatType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;

class ProductType extends AbstractType
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
            ->add('type', TextType::class,
            [
                'label' => 'name'
            ])
            ->add('image', FileType::class,
            [
                'label' => 'Product image',
                'data_class' => null,
                'required' => is_null($builder ->getData() ->getImage())
            ])
            ->add('price', FloatType::class,
            [
                'label' => 'Price',
                'required' => true,
                'attr' =>[
                    'min' => 520000,
                    'max' => 5415015445
                ]
            ] )
            ->add('orderdetail', Entity::class,
            [
                'label' => 'OrderDetail name',
                'required' => true,
                'class' => OrderDetail::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false
            ])
            ->add('cartdetail', Entity::class,
            [
                'label' => 'CartDetail name',
                'required' => true,
                'class' => CartDetail::class,
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
            'data_class' => Product::class,
            // Configure your form options here
        ]);
    }
}
