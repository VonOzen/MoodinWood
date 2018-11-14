<?php

namespace App\Form;

use App\Entity\Product;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProductType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                TextType::class,
                $this->setAttributes("Nom du produit", "Nom du produit")
            )
            ->add(
                'description',
                TextareaType::class,
                $this->setAttributes("Description", "Description du produit")
            )
            ->add(
                'price',
                NumberType::class,
                $this->setAttributes("Prix", "Prix unitaire du produit")
            )
            ->add(
                'type',
                ChoiceType::class,
                [
                    'label'   => 'Type du produit',
                    'choices' => $this->getChoices()
                ]
            )
            ->add(
                'inStock',
                CheckboxType::class,
                [
                    'required' => false
                ]
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

    private function getChoices()
    {
        $choices = Product::TYPE;
        $output  = [];

        foreach($choices as $k => $v) {
            $output[$v] = $k;
        }

        return $output;
    }
}
