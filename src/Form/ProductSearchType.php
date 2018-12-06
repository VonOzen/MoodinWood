<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\ProductSearch;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ProductSearchType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'category',
                EntityType::class,
                [
                    'class'        => Category::class,
                    'choice_label' => 'name',
                    'multiple'     => false,
                    'label'        => false,
                    'required'     => false,
                    'attr'         => [
                        'placeholder' => 'Catégorie de produit'
                    ]
                ]
            )
            ->add(
                'maxPrice',
                IntegerType::class,
                [
                    'label'    => false,
                    'required' => false,
                    'attr'     => [
                        'placeholder' => 'Prix maximum'
                    ]
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'      => ProductSearch::class,
            'method'          => 'get',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
