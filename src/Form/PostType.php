<?php

namespace App\Form;

use App\Entity\Post;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PostType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'title',
                TextType::class,
                $this->setAttributes("Titre", "Titre de l'article")
            )
            ->add(
                'preview',
                TextType::class,
                $this->setAttributes("Introduction", "Texte d'introduction de l'article")
            )
            ->add(
                'content',
                TextareaType::class,
                $this->setAttributes("Contenu de l'article", "Texte principal de l'article")
            )
            ->add(
                'imageFile',
                FileType::class,
                [
                    'required' => false,
                    'label'    => 'Upload une image'
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
