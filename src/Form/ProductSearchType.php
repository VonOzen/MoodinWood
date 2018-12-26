<?php

namespace App\Form;

use App\Entity\Type;
use App\Entity\Product;
use App\Entity\ProductSearch;
use App\Form\ApplicationType;
use App\Repository\TypeRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ProductSearchType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            /*->add(
                'productType',
                EntityType::class,
                [
                    'class'    => Type::class,
                    'query_builder' => function (TypeRepository $repo) {
                      $repo->getAllTypesName();
                    },
                    'choices' => $types,
                    'label'    => false,
                    'required' => false,
                    
                ]
            )*/
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
            'data_class' => ProductSearch::class,
            'method'     => 'get',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }

    public function getAllTypesName(): Array
    {
        $types = [
            1 => 'couteaux',
            2 => 'cuillères',
            3 => 'fourchettes'
        ];
        return array_flip($types);
    }
}
