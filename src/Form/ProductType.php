<?php

namespace App\Form;

use App\Entity\Product;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name'
            )
            ->add(
                'description'
            )
            ->add(
                'type'
            )
            ->add(
                'price'
            )
            ->add(
                'inStock'
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'         => Product::class,
            'translation_domain' => 'forms'
        ]);
    }
}
